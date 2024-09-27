@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Support Ticket List') }}
                        @if (auth()->user()->user_group == 2)
                            <a href="{{ route('issues.create') }}" class="btn btn-info">
                                {{ __('Open Support Ticket') }}
                            </a>
                        @endif
                    </div>

                    <div class="card-body bg-light">
                        <table id="ticketTable" class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Ticket Number</th>
                                    <th>Issue Opened Time</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    @if (auth()->user()->user_group == 1)
                                        <th>User Name</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataArr as $index => $data)
                                    <tr>
                                        <th>{{ $index + 1 }}</th>
                                        <td>{{ $data->ticket_number }}</td>
                                        <td>{{ (!empty($data->created_at)) ? $data->created_at->format('Y-m-d H:i') : '' }}</td>
                                        <td>{{ $data->details }}</td>
                                        <td>{{ $data->status }}</td>
                                        @if (auth()->user()->user_group == 1)
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->remarks }}</td>
                                            <td>
                                                @if ($data->status == 'Open')
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#updateModal" data-id="{{ $data->id }}"
                                                        data-remarks="{{ $data->remarks }}"
                                                        data-status="{{ $data->status }}">
                                                        Update
                                                    </button>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- @if ($dataArr->isEmpty())
                            <p class="text-center">No tickets found.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title" id="updateModalLabel">Update Ticket Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="updateForm" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" id="ticketId" name="ticket_id">
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks<span class="text-danger">*</span></label>
                                <textarea id="remarks" class="form-control" name="remarks" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                                <select id="status" class="form-select" name="status" required>
                                    <option selected value="Closed">Closed</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary updateData">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ticketTable').DataTable();

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-top-right",
                onclick: null,
            };

            $('#updateModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#ticketId').val(button.data('id'));
            });

            $(document).on("click", ".updateData", function() {
                $(".updateData").prop('disabled', true);
                var formData = new FormData($('#updateForm')[0]);
                const ticketId = $('#ticketId').val(); // get the ticket ID

                $.ajax({
                    url: "{{ url('issues/update') }}/" + ticketId,
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        toastr.success(res.message, "Success", options);
                        location.reload();
                    },
                    error: function(jqXhr) {
                        $(".updateData").prop('disabled', false);
                        if (jqXhr.status == 400) {
                            var errorsHtml = '';
                            var errors = jqXhr.responseJSON.message;
                            $.each(errors, function(key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                        } else {
                            toastr.error(jqXhr.responseJSON.message, "Error", options);
                        }
                    }
                });
            });
        });
    </script>
@endsection

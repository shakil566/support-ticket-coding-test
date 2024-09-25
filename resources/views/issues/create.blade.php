@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Open Support Ticket') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('issues') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="ticket_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ticket Number') }}</label>

                                <div class="col-md-6">
                                    <input id="ticket_number" type="text" class="form-control" name="ticket_number"
                                        value="{{ $ticketNumber }}" readonly autocomplete="ticket_number">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="details" class="col-md-4 col-form-label text-md-end">{{ __('Issue Details') }}
                                    <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details"
                                        autocomplete="details" autofocus>{{ old('details') }}</textarea>

                                    @error('details')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('issues') }}" type="button" class="btn btn-info">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

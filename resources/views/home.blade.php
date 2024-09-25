@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">{{ __('Support Ticket System') }}</h2>
        @if (auth()->user()->user_group == 2)
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 text-center">
                    <a href="{{ route('issues.create') }}" class="btn btn-primary">{{ __('Open Support Ticket') }}</a>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-white bg-info mb-4">
                            <div class="card-header">{{ __('Open Tickets') }}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $openTicketsCount }}</h5>
                                <p class="card-text">Total open tickets waiting to be resolved.</p>
                                <a href="{{ route('issues') }}" class="btn btn-light">View Open Tickets</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-white bg-success mb-4">
                            <div class="card-header">{{ __('Closed Tickets') }}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $closedTicketsCount }}</h5>
                                <p class="card-text">Total tickets that have been resolved.</p>
                                <a href="{{ route('issues') }}" class="btn btn-light">View Closed Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

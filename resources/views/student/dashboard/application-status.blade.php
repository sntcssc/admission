@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('student.dashboard.partials.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Application Status - {{ $application->advertisement->title }}</h1>
            </div>

            @include('partials.alerts')

            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Program Details</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Program Name</dt>
                                <dd class="col-sm-8">{{ $application->advertisement->batchProgram->program->name }}</dd>

                                <dt class="col-sm-4">Batch Code</dt>
                                <dd class="col-sm-8">{{ $application->advertisement->batchProgram->batch->code }}</dd>

                                <dt class="col-sm-4">Application Date</dt>
                                <dd class="col-sm-8">{{ $application->created_at->format('M d, Y H:i') }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Status Overview</h5>
                            <div class="alert alert-{{ $application->status === 'approved' ? 'success' : 'info' }}">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-uppercase">{{ $application->status }}</strong>
                                    <span class="badge bg-dark">
                                        {{ $application->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                                @if($application->status === 'approved')
                                <div class="mt-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Your application has been approved
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Application Timeline</h5>
                    <div class="timeline">
                        @foreach($application->statusHistories as $history)
                        <div class="timeline-item">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <strong class="me-3">{{ $history->event_type }}</strong>
                                    <small class="text-muted">{{ $history->created_at->format('M d, Y H:i') }}</small>
                                </div>
                                @if($history->event_data)
                                <div class="mt-1 small text-muted">
                                    @foreach(json_decode($history->event_data, true) as $key => $value)
                                    <div>{{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}</div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
}
.timeline-point {
    position: absolute;
    left: -18px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #0d6efd;
    border: 2px solid white;
}
.timeline-content {
    padding: 10px 15px;
    background-color: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #dee2e6;
}
</style>
@endpush
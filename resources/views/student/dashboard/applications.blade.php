{{-- resources/views/student/dashboard/applications.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('student.dashboard.partials.sidebar')
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Available Applications</h1>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($advertisements as $ad)
                <div class="col">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    Apply Between: {{ $ad->application_start->format('d M Y') }} - 
                                    {{ $ad->application_end->format('d M Y') }}
                                </small>
                            </p>
                            <a href="{{ route('student.application.create', $ad->id) }}" 
                               class="btn btn-primary">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Admission Application</h3>
                    <div class="steps">
                        @foreach(['Personal', 'Academic', 'Documents', 'Payment'] as $step)
                            <span class="step @if($loop->first) active @endif">{{ $step }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="card-body">
                    <form id="applicationForm" method="POST" 
                        action="{{ route('applications.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Personal Details Step -->
                        <div class="step-content" data-step="1">
                            @include('applications.steps.personal')
                        </div>

                        <!-- Academic Details Step -->
                        <div class="step-content d-none" data-step="2">
                            @include('applications.steps.academic')
                        </div>

                        <!-- Document Upload Step -->
                        <div class="step-content d-none" data-step="3">
                            @include('applications.steps.documents')
                        </div>

                        <!-- Payment Step -->
                        <div class="step-content d-none" data-step="4">
                            @include('applications.steps.payment')
                        </div>

                        <div class="form-navigation mt-4">
                            <button type="button" class="btn btn-secondary previous">
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Next
                            </button>
                            <button type="submit" class="btn btn-success submit d-none">
                                Final Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
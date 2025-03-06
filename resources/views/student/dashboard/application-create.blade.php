@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('student.dashboard.partials.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Apply for {{ $advertisement->title }}</h1>
            </div>

            @include('partials.alerts')

            <form method="POST" action="{{ route('student.applications.store') }}" id="applicationForm">
                @csrf
                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">

                <!-- UPSC Attempts Section -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">UPSC Attempt Details</h5>
                    </div>
                    <div class="card-body">
                        <div id="upscAttemptsContainer">
                            <div class="attempt-template mb-3">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <input type="number" name="upsc_attempts[0][exam_year]" 
                                               class="form-control" placeholder="Year" min="2000" 
                                               value="{{ old('upsc_attempts.0.exam_year') }}" required>
                                        @error('upsc_attempts.0.exam_year')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="upsc_attempts[0][roll_number]" 
                                               class="form-control" placeholder="Roll Number"
                                               value="{{ old('upsc_attempts.0.roll_number') }}" required>
                                        @error('upsc_attempts.0.roll_number')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="upsc_attempts[0][prelims_cleared]"
                                                   @checked(old('upsc_attempts.0.prelims_cleared', false))>
                                            <label class="form-check-label">Prelims Cleared</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="upsc_attempts[0][mains_cleared]"
                                                   @checked(old('upsc_attempts.0.mains_cleared', false))>
                                            <label class="form-check-label">Mains Cleared</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" 
                                onclick="addUpscAttempt()">
                            <i class="bi bi-plus-circle me-2"></i>Add Another Attempt
                        </button>
                    </div>
                </div>

                <!-- Employment History Section -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Employment Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" 
                                   name="employment_history[is_employed]" id="isEmployed"
                                   @checked(old('employment_history.is_employed', false))>
                            <label class="form-check-label" for="isEmployed">
                                Currently Employed
                            </label>
                        </div>
                        <div id="employmentDetails" style="display: none;">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" 
                                           name="employment_history[designation]" 
                                           placeholder="Designation"
                                           value="{{ old('employment_history.designation') }}">
                                    @error('employment_history.designation')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" 
                                           name="employment_history[employer]" 
                                           placeholder="Employer Name"
                                           value="{{ old('employment_history.employer') }}">
                                    @error('employment_history.employer')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" 
                                           name="employment_history[location]" 
                                           placeholder="Location"
                                           value="{{ old('employment_history.location') }}">
                                    @error('employment_history.location')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-send-check me-2"></i>Submit Application
                </button>
            </form>
        </main>
    </div>
</div>

<script>
let attemptCount = 1;

function addUpscAttempt() {
    const container = document.getElementById('upscAttemptsContainer');
    const newAttempt = container.children[0].cloneNode(true);
    
    // Update input names
    newAttempt.querySelectorAll('input').forEach(input => {
        const name = input.name.replace('[0]', `[${attemptCount}]`);
        input.name = name;
        input.value = '';
    });
    
    container.appendChild(newAttempt);
    attemptCount++;
}

document.getElementById('isEmployed').addEventListener('change', function() {
    document.getElementById('employmentDetails').style.display = 
        this.checked ? 'block' : 'none';
});

// Initialize employment section if returning with errors
document.addEventListener('DOMContentLoaded', function() {
    if(document.getElementById('isEmployed').checked) {
        document.getElementById('employmentDetails').style.display = 'block';
    }
});
</script>
@endsection
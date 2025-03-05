@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Registration') }}</div>

                <div class="card-body">
                    <form id="registrationForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>

                        <!-- Add other fields -->

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" 
                                    onclick="showPreview()">
                                    Preview & Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration Preview</h5>
            </div>
            <div class="modal-body" id="previewContent">
                <!-- Preview content will be injected here -->
            </div>
            <div class="modal-footer">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="confirmationCheck">
                    <label class="form-check-label" for="confirmationCheck">
                        I confirm the details are correct
                    </label>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-primary" 
                    id="submitButton" disabled
                    onclick="submitForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
function showPreview() {
    // Validate form
    if(!document.getElementById('registrationForm').checkValidity()) {
        document.getElementById('registrationForm').reportValidity();
        return;
    }

    // Generate preview content
    const formData = new FormData(document.getElementById('registrationForm'));
    let previewHtml = '<dl class="row">';
    
    for (const [key, value] of formData.entries()) {
        previewHtml += `
            <dt class="col-sm-3">${key.replace('_', ' ').toUpperCase()}</dt>
            <dd class="col-sm-9">${value}</dd>
        `;
    }
    
    document.getElementById('previewContent').innerHTML = previewHtml;
    const modal = new bootstrap.Modal('#previewModal');
    modal.show();
}

document.getElementById('confirmationCheck').addEventListener('change', (e) => {
    document.getElementById('submitButton').disabled = !e.target.checked;
});

function submitForm() {
    document.getElementById('registrationForm').submit();
}
</script>
@endsection
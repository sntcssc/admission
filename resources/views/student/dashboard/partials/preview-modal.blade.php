<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Your Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent"></div>
                
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="confirmationCheck">
                    <label class="form-check-label" for="confirmationCheck">
                        I have re-checked the above details and found correct.
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-primary" id="submitBtn" 
                        onclick="submitForm()" disabled>Create Account</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('confirmationCheck').addEventListener('change', function() {
    document.getElementById('submitBtn').disabled = !this.checked;
});

function submitForm() {
    if(confirm('Once submitted, the data cannot be modified. Proceed?')) {
        // Check OTP verification status
        const emailVerified = document.getElementById('emailVerifiedIcon').classList.contains('d-none');
        const mobileVerified = document.getElementById('mobileVerifiedIcon').classList.contains('d-none');
        
        if(emailVerified || mobileVerified) {
            alert('Please verify both email and mobile before submitting');
            return;
        }

        document.getElementById('registrationForm').submit();
    }
}
</script>
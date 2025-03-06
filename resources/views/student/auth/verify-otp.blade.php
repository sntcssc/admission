<div class="modal fade" id="otpModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Verify OTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="otpForm" onsubmit="return false">
                    <input type="hidden" id="otpType" name="type">
                    <input type="hidden" id="otpCooldown" value="{{ config('otp.resend_cooldown') }}">

                    <div class="mb-3">
                        <label for="otpCode" class="form-label">Enter OTP</label>
                        <input type="text" class="form-control" id="otpCode" name="code" 
                               maxlength="6" pattern="\d{6}" required>
                        <small class="text-muted">Valid for <span id="otpCountdown">2:00</span></small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" id="resendOtpBtn"
                                onclick="handleResendOtp()" disabled>
                            Resend OTP
                        </button>
                        <button type="submit" class="btn btn-primary" onclick="verifyOtp()">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // function verifyOtp() {
    //     const formData = new FormData(document.getElementById('otpForm'));
    //     const type = document.getElementById('otpType').value;
        
    //     fetch('/verify-otp', {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    //             'Accept': 'application/json'
    //         },
    //         body: JSON.stringify({
    //             type: type,
    //             code: formData.get('code'),
    //             email: document.getElementById('email').value,
    //             mobile: document.getElementById('mobile').value
    //         })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if(data.error) {
    //             alert(data.error);
    //             return;
    //         }
            
    //         bootstrap.Modal.getInstance(document.getElementById('otpModal')).hide();
    //         document.getElementById(`${type}VerifiedIcon`).classList.remove('d-none');
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

    function verifyOtp() {
        const formData = new FormData(document.getElementById('otpForm'));
        const type = formData.get('type');
        const code = formData.get('code');

        fetch('/verify-otp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                type: type,
                code: code,
                email: formData.get('email'),
                mobile: formData.get('mobile')
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                alert(data.error);
                return;
            }

            bootstrap.Modal.getInstance(document.getElementById('otpModal')).hide();
            document.getElementById(`${type}VerifiedIcon`).classList.remove('d-none');
        
            // Store verification status in session
            if(type === 'email') {
                sessionStorage.setItem('emailVerified', 'true');
            } else {
                sessionStorage.setItem('mobileVerified', 'true');
            }

        })
        // .catch(error => console.error('Error:', error));
        .catch(error => {
            toastr.error('An error occurred during verification');
            console.error('Error:', error);
        });
    }
</script>
@extends('student.layouts.auth')

@section('auth-title', 'Student Registration')

@section('auth-content')
<form id="registrationForm" method="POST" action="{{ route('student.register') }}">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <label for="secondary_roll" class="form-label">Secondary Roll No.</label>
            <input type="text" class="form-control" id="secondary_roll" name="secondary_roll" value="{{ old('secondary_roll') }}" required>
        </div>

        <div class="col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div class="col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Mobile Verification</label>
            <div class="input-group">
                <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" value="{{ old('mobile') }}" required>
                <button type="button" class="btn btn-outline-primary verify-btn" data-type="mobile">
                    Verify <i class="bi bi-check-circle-fill text-success {{ session('mobile_verified') ? '' : 'd-none' }}" id="mobileVerifiedIcon"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email Verification</label>
            <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                <button type="button" class="btn btn-outline-primary verify-btn" data-type="email">
                    Verify <i class="bi bi-check-circle-fill text-success {{ session('email_verified') ? '' : 'd-none' }}" id="emailVerifiedIcon"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="12345678" required>
        </div>

        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="12345678" required>
        </div>

        <div class="col-12 mt-4">
            <button type="button" class="btn btn-primary w-100" onclick="showPreview()">Preview & Submit</button>
        </div>
    </div>
</form>

@include('student.auth.verify-otp')
@include('student.dashboard.partials.preview-modal')

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifyBtns = document.querySelectorAll('.verify-btn');
        
        verifyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const type = this.dataset.type;
                showOtpModal(type);
            });
        });
    });

    // function showOtpModal(type) {
    //     const modal = new bootstrap.Modal(document.getElementById('otpModal'));
    //     const modalTitle = document.getElementById('otpModalLabel');
    //     const otpTypeInput = document.getElementById('otpType');
        
    //     modalTitle.textContent = `Verify ${type.charAt(0).toUpperCase() + type.slice(1)}`;
    //     otpTypeInput.value = type;
        
    //     fetch(`/send-otp?type=${type}`, {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    //             'Accept': 'application/json'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         if(data.error) {
    //             alert(data.error);
    //             return;
    //         }
    //         modal.show();
    //         startOtpCountdown(data.expires_in * 60);
    //     })
    //     .catch(error => console.error('Error:', error));
    // }

    function showOtpModal(type) {
        const modal = new bootstrap.Modal(document.getElementById('otpModal'));
        const modalTitle = document.getElementById('otpModalLabel');
        const otpTypeInput = document.getElementById('otpType');

        modalTitle.textContent = `Verify ${type.charAt(0).toUpperCase() + type.slice(1)}`;
        otpTypeInput.value = type;

        // Determine which field to include based on the verification type
        let requestData = {
            type: type
        };

        if (type === 'mobile') {
            requestData.mobile = document.getElementById('mobile').value;
        } else if (type === 'email') {
            requestData.email = document.getElementById('email').value;
        }

        fetch('/send-otp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            modal.show();
            startOtpCountdown(data.expires_in * 60);
        })
        .catch(error => console.error('Error:', error));
    }

    function startOtpCountdown(seconds) {
        const countdownElement = document.getElementById('otpCountdown');
        let remaining = seconds;
        
        const timer = setInterval(() => {
            const minutes = Math.floor(remaining / 60);
            const secs = remaining % 60;
            countdownElement.textContent = `${minutes}:${secs.toString().padStart(2, '0')}`;
            
            if (remaining <= 0) clearInterval(timer);
            remaining--;
        }, 1000);
    }

    function handleResendOtp() {
        const type = document.getElementById('otpType').value;
        const cooldown = parseInt(document.getElementById('otpCooldown').value);
        const resendBtn = document.getElementById('resendOtpBtn');
        
        resendBtn.disabled = true;
        let seconds = cooldown;
        
        const timer = setInterval(() => {
            resendBtn.textContent = `Resend OTP (${seconds}s)`;
            seconds--;
            
            if (seconds < 0) {
                clearInterval(timer);
                resendBtn.disabled = false;
                resendBtn.textContent = 'Resend OTP';
            }
        }, 1000);
        
        fetch('/send-otp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                type: type,
                is_resend: true,
                email: document.getElementById('email').value,
                mobile: document.getElementById('mobile').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                startOtpCountdown(data.expires_in * 60);
            }
        });
    }

    function showPreview() {
        const formData = new FormData(document.getElementById('registrationForm'));
        const previewContent = document.getElementById('previewContent');
        
        let html = '<dl class="row">';
        for (const [key, value] of formData.entries()) {
            if(key === 'password' || key === 'password_confirmation') continue;
            html += `<dt class="col-sm-4">${key.replace('_', ' ').toUpperCase()}</dt>
                    <dd class="col-sm-8">${value}</dd>`;
        }
        html += '</dl>';
        
        previewContent.innerHTML = html;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }
</script>

<script>
    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Restore verification status from session
        if(sessionStorage.getItem('emailVerified')) {
            document.getElementById('emailVerifiedIcon').classList.remove('d-none');
        }
        if(sessionStorage.getItem('mobileVerified')) {
            document.getElementById('mobileVerifiedIcon').classList.remove('d-none');
        }
        
        // Clear session storage on form submit
        document.getElementById('registrationForm').addEventListener('submit', function() {
            sessionStorage.removeItem('emailVerified');
            sessionStorage.removeItem('mobileVerified');
        });
    });
</script>
@endpush
@endsection
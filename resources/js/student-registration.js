// resources/js/student-registration.js
function handleResendOtp(type) {
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
            showError(data.error);
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.step-content');
    const stepIndicators = document.querySelectorAll('.step');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('d-none', index !== stepIndex);
        });
        
        stepIndicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === stepIndex);
        });

        document.querySelector('.previous').style.display = 
            stepIndex === 0 ? 'none' : 'inline-block';
            
        document.querySelector('.next').style.display = 
            stepIndex === steps.length - 1 ? 'none' : 'inline-block';
            
        document.querySelector('.submit').style.display = 
            stepIndex === steps.length - 1 ? 'inline-block' : 'none';
    }

    function validateStep(stepIndex) {
        const currentStepForm = steps[stepIndex];
        return currentStepForm.checkValidity();
    }

    document.querySelector('.next').addEventListener('click', function() {
        if(validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    document.querySelector('.previous').addEventListener('click', function() {
        currentStep--;
        showStep(currentStep);
    });

    // Initialize form
    showStep(currentStep);
});
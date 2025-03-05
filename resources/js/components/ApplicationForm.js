class ApplicationForm {
    constructor() {
        this.steps = document.querySelectorAll('.application-step');
        this.currentStep = 0;
        this.init();
    }

    init() {
        this.showStep(this.currentStep);
        this.addNavigationListeners();
    }

    showStep(n) {
        this.steps.forEach((step, index) => {
            step.style.display = index === n ? 'block' : 'none';
        });
    }

    validateStep(n) {
        const inputs = this.steps[n].querySelectorAll('input, select, textarea');
        return Array.from(inputs).every(input => input.reportValidity());
    }

    nextStep() {
        if (this.validateStep(this.currentStep)) {
            this.currentStep++;
            this.showStep(this.currentStep);
        }
    }

    addNavigationListeners() {
        document.querySelectorAll('.next-step').forEach(button => {
            button.addEventListener('click', () => this.nextStep());
        });
    }
}

new ApplicationForm();
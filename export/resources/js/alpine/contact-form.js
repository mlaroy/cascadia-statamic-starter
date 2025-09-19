export default () => ({
    init() {
        // console.log('Contact form initialized');
        const form = this.$refs.form;
        this.form = this.$refs.form;
        this.formData._token = this.form.querySelector('input[name="_token"]').value;
    },

    errors: [],
    success: false,
    isSubmitting: false,
    form: null,
    formData: {
        name: '',
        email: '',
        message: '',
        honeypot: '',
        _token: '', // Set this in init
    },

    async submitForm(event) {
        this.isSubmitting = true;
        this.errors = [];
        this.success = false;

        try {
            const response = await fetch( event.target.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(this.formData),
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    this.success = true;
                    this.resetForm();
                } else if (result.errors) {
                    this.errors = result.errors;
                }
            } else {
                const errorData = await response.json();
                this.errors = errorData.errors || ["Something went wrong. Please try again later."];
            }
        } catch (error) {
            this.errors = ["An unexpected error occurred. Please try again later."];
        } finally {
            this.isSubmitting = false;
        }
    },

    resetForm() {
        this.name = '';
        this.email = '';
        this.email = '';
        this.errors = [];
        this.isSubmitting = false;
    }
})

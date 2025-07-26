document.addEventListener('DOMContentLoaded', function() {
    console.log('Profile validation script loaded');
    
    const form = document.querySelector('form');
    if (!form) {
        console.error('Form not found!');
        return;
    }
    console.log('Form found:', form);

    // منع السلوك الافتراضي للنموذج
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');
        submitForm();
    });

    // Handle Enter key press on input fields
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                submitForm();
            }
        });
    });

    function submitForm() {
        console.log('Starting form submission');
        const formData = new FormData(form);
        
        // عرض حالة التحميل
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) {
            const originalButtonText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = 'جاري الحفظ...';
        }

        // إرسال البيانات
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Response received:', response);
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            if (data.status === 'error') {
                showErrors(data.errors);
                if (data.field) {
                    scrollToError(data.field);
                }
            } else {
                showSuccess(data.message);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Error occurred:', error);
            showError('حدث خطأ أثناء حفظ البيانات');
        })
        .finally(() => {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        });
    }

    function showErrors(errors) {
        console.log('Showing errors:', errors);
        clearErrors();

        Object.keys(errors).forEach(field => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-danger mt-1';
                errorDiv.textContent = errors[field][0];
                input.classList.add('is-invalid');
                input.parentNode.appendChild(errorDiv);
            }
        });
    }

    function clearErrors() {
        form.querySelectorAll('.error-message').forEach(el => el.remove());
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    }

    function scrollToError(fieldName) {
        const field = form.querySelector(`[name="${fieldName}"]`);
        if (field) {
            field.scrollIntoView({ behavior: 'smooth', block: 'center' });
            field.focus();
        }
    }

    function showSuccess(message) {
        console.log('Showing success message:', message);
        let successDiv = document.querySelector('.success-message');
        if (!successDiv) {
            successDiv = document.createElement('div');
            successDiv.className = 'success-message alert alert-success mt-3';
            form.parentNode.insertBefore(successDiv, form);
        }
        successDiv.textContent = message;
    }

    function showError(message) {
        console.log('Showing error message:', message);
        let errorDiv = document.querySelector('.error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message alert alert-danger mt-3';
            form.parentNode.insertBefore(errorDiv, form);
        }
        errorDiv.textContent = message;
    }
}); 
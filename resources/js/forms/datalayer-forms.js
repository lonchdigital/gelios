document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('[id^="form-meeting"]');

    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = {
                name: form.querySelector('[name="name"]').value,
                phone: form.querySelector('[name="phone"]').value,
                doctor: form.querySelector('[name="doctor"]').value,
                clinic: form.querySelector('[name="clinic"]').value,
            };

            fetch('/feedback-store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // window.dataLayer = window.dataLayer || [];
                        dataLayer.push({
                            event: 'zapysatysya_na_pryiom_iLion',
                            phone_number: formData.phone,
                            email: '',
                            'address.first_name': formData.name
                        });

                        const closeButton = document.getElementById('close-appointment-modal');
                        if (closeButton) closeButton.click();

                        form.reset();
                        const modalElement = $('#popup--appointment-thank');
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                        setTimeout(() => modal.hide(), 2000);
                    } else {
                        const errors = data.errors;
                        for (const field in errors) {
                            const fieldElement = form.querySelector(`#${field}_error`);
                            const existingError = fieldElement?.nextElementSibling;
                            if (existingError && existingError.classList.contains('field--help-info')) {
                                existingError.textContent = errors[field][0];
                            } else if (fieldElement) {
                                fieldElement.insertAdjacentHTML('afterend', '<div class="field--help-info small-txt text-red mb-2">' + errors[field][0] + '</div>');
                            }
                        }
                    }
                })
                .catch(error => console.error("Error submitting form:", error));
        });
    });

    const form = document.querySelector('[id="form-any-questions"]');
    if (!form) return;

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = {
            name: form.querySelector('[name="name"]').value,
            phone: form.querySelector('[name="phone"]').value,
        };

        fetch('/feedback-question-store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(formData),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // window.dataLayer = window.dataLayer || [];
                    dataLayer.push({
                        event: 'zalyshylys_pytannia_iLion',
                        phone_number: formData.phone,
                        email: '',
                        'address.first_name': formData.name
                    });

                    form.reset();
                    const modalElement = $('#popup--appointment-thank');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                    setTimeout(() => modal.hide(), 2000);
                } else {
                    const errors = data.errors;
                    for (const field in errors) {
                        const fieldElement = form.querySelector(`#${field}_error`);
                        const existingError = fieldElement?.nextElementSibling;
                        if (existingError && existingError.classList.contains('field--help-info')) {
                            existingError.textContent = errors[field][0];
                        } else if (fieldElement) {
                            fieldElement.insertAdjacentHTML('afterend', '<div class="field--help-info small-txt text-red mb-2">' + errors[field][0] + '</div>');
                        }
                    }
                }
            })
            .catch(error => console.error("Error submitting form:", error));
    });
});

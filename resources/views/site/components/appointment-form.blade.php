<form id="form-meeting-{{ $id ?? 1 }}" class="p-3 p-lg-5 bg-white" action="{{ route('feedback.store') }}">
    @csrf
    @method('POST')
    <div class="h2 font-m font-weight-bolder mb-5">{{ __('pages.make_an_appointment') ?? 'Записатися на прийом' }}</div>
    <div class="row field-wrap">
        <div class="col-12">
            <div class="field mb-2">
                <label class="control-label mb-2" for="form-meeting-name">{{ __('pages.enter_your_full_name') }}</label>
                <input type="text" id="form-meeting-name" name="name" class="form-control mb-2">
                <div class="field--help-info small-txt text-red mb-2">{{ __('pages.enter_your_full_name') }}</div>
            </div>
            <div id="name_error" class="field--help-info small-txt text-red mb-2"></div>
        </div>
        <div class="col-12">
            <div class="field mb-2">
                <label class="control-label mb-2" for="form-meeting-phone">{{ __('pages.enter_your_phone_number') }}</label>
                <input type="phone" id="form-meeting-phone" value="{{ old('phone') ?? '+380' }}" name="phone" class="form-control mb-2">
                <div class="field--help-info small-txt text-red mb-2">{{ __('pages.enter_your_phone_number') }}</div>
            </div>
            <div id="phone_error" class="field--help-info small-txt text-red mb-2"></div>
        </div>
        <div class="col-12">
            <div class="field mb-2">
                <div class="control-label mb-2">{{ __('pages.choose_a_specialist') }}</div>
                <div class="select-wrap">
                    <select class="select-choose-specialist" name="doctor">
                        <option></option>
                        @forelse($doctors as $doctor)
                            <option value="{{ $doctor->title }}">{{ $doctor->title }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="field--help-info small-txt text-red mb-2">{{ __('pages.choose_a_specialist') }}</div>
            </div>
            <div id="doctor_error" class="field--help-info small-txt text-red mb-2"></div>
        </div>
        <div class="col-12">
            <div class="field mb-2">
                <div class="control-label mb-2">{{ __('pages.choose_a_clinic') }}</div>
                <div class="select-wrap">
                    <select class="select-choose-clinic" name="clinic">
                        <option></option>
                        @forelse($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @empty
                        @endforelse
                        {{-- <option value="1">Клініка 1</option>
                        <option value="2">Клініка 2</option>
                        <option value="3">Клініка 3</option>
                        <option value="4">Клініка 4</option> --}}
                    </select>
                </div>
                <div class="field--help-info small-txt text-red mb-2">{{ __('pages.choose_a_clinic') }}</div>
            </div>
            <div id="clinic_error" class="field--help-info small-txt text-red mb-2"></div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-blue font-weight-bold w-100 mt-2">{{ __('pages.sign_up') }}</button>
        </div>
    </div>
    <script>
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify(formData),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log("Form submitted successfully!");
                            } else {
                                console.log(data);

                                const errors = data.errors;
                                console.log(errors);

                                for (const field in errors) {
                                    const fieldElement = form.querySelector(`#${field}_error`);
                                    console.log(fieldElement);
                                    const existingError = fieldElement?.nextElementSibling;

                                    if (existingError && existingError.classList.contains('field--help-info')) {
                                        existingError.textContent = errors[field][0];
                                    } else if (fieldElement) {
                                        fieldElement.insertAdjacentHTML(
                                            'afterend',
                                            '<div class="field--help-info small-txt text-red mb-2">' +
                                            errors[field][0] + '</div>'
                                        );
                                    }
                                }
                            }
                        })
                        .catch(error => {
                            console.error("Error submitting form:", error);
                        });
                });
            });
        });
    </script>
</form>

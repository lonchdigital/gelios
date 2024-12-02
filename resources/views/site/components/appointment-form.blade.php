<form id="form-meeting" class="p-3 p-lg-5 bg-white" action="{{ route('feedback.store') }}">
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
                <input type="tel" id="form-meeting-phone" name="phone" class="form-control mb-2">
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
                        <option value="1">Клініка 1</option>
                        <option value="2">Клініка 2</option>
                        <option value="3">Клініка 3</option>
                        <option value="4">Клініка 4</option>
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
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById("form-meeting").addEventListener("submit", function(event) {
                event.preventDefault();

                const form = document.getElementById('form-meeting');

                const formData = {
                    name: document.querySelector('[name="name"]').value,
                    phone: document.querySelector('[name="phone"]').value,
                    doctor: document.querySelector('[name="doctor"]').value,
                    clinic: document.querySelector('[name="clinic"]').value,
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

                        } else {
                            console.log(data);

                            var errors = data.errors;
                            console.log(errors);
                            for (var field in errors) {
                                var fieldElement = $('#' + field + '_error');
                                console.log(fieldElement);
                                var existingError = fieldElement.next('.field--help-info');

                                if (existingError.length) {
                                    existingError.text(errors[field][0]);
                                } else {
                                    fieldElement.after(
                                        '<div class="field--help-info small-txt text-red mb-2">' +
                                        errors[field][0] + '</div>');
                                }
                            }
                        }
                    })
                    .catch();
            });
        });
    </script>
</form>

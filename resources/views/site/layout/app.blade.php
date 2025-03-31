<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL') }}">
    <meta name="app-locale" content="{{ app()->getLocale() }}">
    <link rel="icon" href="{{ asset('/static_images/cropped-favicon-32x32.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('/static_images/cropped-favicon-192x192.png') }}" type="image/png"
        sizes="192x192">

    <script>
        const translations = {
            nothing_found: "{{ trans('web.nothing_found') }}",
            free: "{{ trans('web.free') }}",
            sign_up_for_for_appointment: "{{ trans('pages.sign_up_for_for_appointment') }}",
            plot_the_route: "{{ trans('web.plot_the_route') }}"
        };
    </script>

    @yield('head')

    <link rel="shortcut icon" href="##" type="image/x-icon" />
    {{-- TODO:: remove --}}
    {{-- <link rel="stylesheet" href="{{ asset('styles/css/libs.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('styles/css/main.min.css') }}"> --}}

    @vite(['resources/js/app.js'])

    <style>
        /**
  * Reinstate scrolling for non-JS clients
  */
        .simplebar-content-wrapper {
            scrollbar-width: auto;
            -ms-overflow-style: auto;
        }

        .simplebar-content-wrapper::-webkit-scrollbar,
        .simplebar-hide-scrollbar::-webkit-scrollbar {
            display: initial;
            width: initial;
            height: initial;
        }
    </style>

    @section('SEO')
        <meta name="description" content="{{ config('app.name') }}">
    @show

    @section('OG')
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="{{ config('app.name') }}" />
        <meta name="twitter:creator" content="{{ config('app.name') }}" />

        <meta property="og:title" content="{{ config('app.name') }}" />
        <meta property="og:description" content="{{ config('app.name') }}" />
        <meta property="og:image" content="{{ asset('/images/logos/logo-gold.svg') }}" />
    @show

    @section('NOINDEX')
    @show

    <script type="application/ld+json">
        { "@context" : "https://schema.org",
          "@type" : "Organization",
           "url": "{{ config('app.url') }}",
           "logo": "{{ $headerImage ?? asset('static_images/logo.png') }}"
        }
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="popup-bg-body" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation"></div>
        @include('site.parts.header')
        <main class="@yield('main_class')">
            @yield('content')

            <div class="modal modal--custom popup--sign-up-appointment fade" id="popup--sign-up-appointment"
                data-keyboard="false" tabindex="-1" aria-labelledby="popup--sign-up-appointmentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                        <div class="modal-body p-0">
                            <form class="form-popup--sign-up-appointment" id="form-meeting-3" autocomplete="off"
                                action="{{ route('feedback.store') }}">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col position-static">
                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                            <div class="h2 font-m modal-title font-weight-bolder mb-0 pr-8">
                                                {{ __('pages.make_an_appointment') ?? 'Записатися на прийом' }}</div>
                                            <button type="button" class="close" id="close-appointment-modal" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    <svg>
                                                        <use
                                                            xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-close' }}">
                                                        </use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                                <select class="select-choose-specialists" name="doctor">
                                                    <option></option>
                                                    @forelse($doctors as $doctor)
                                                        <option value="{{ $doctor->title }}">{{ $doctor->title }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div id="doctor_error" class="field--help-info small-txt text-red mb-2"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="field mb-2">
                                            <div class="control-label mb-2">{{ __('pages.choose_a_clinic') }}</div>
                                            <div class="select-wrap">
                                                <select class="select-choose-clinics" name="clinic">
                                                    <option></option>
                                                    @forelse($clinics as $clinic)
                                                        <option value="{{ $clinic->id }}">{{ $clinic->title }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div id="clinic_error" class="field--help-info small-txt text-red mb-2"></div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-blue font-weight-bold w-100 mt-2">{{ __('pages.sign_up') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('site.parts.footer')

        <div id="btnTop" class="btn btn-arrow-up">
            <svg>
                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-arrow-small-down' }}"></use>
            </svg>
        </div>
    </div>

    <div class="modal modal--custom popup--contacts fade" id="popup--contacts" data-keyboard="false" tabindex="-1"
        aria-labelledby="popup--contactsLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col position-static">
                            <div class="d-flex align-items-start justify-content-between mb-5">
                                <div class="h1 font-m modal-title font-weight-bolder mb-0 pr-8" id="modal-city"></div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        <svg>
                                            <use
                                                xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-close' }}">
                                            </use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg mb-5 mb-lg-0">
                            <div class="map-body h-100 rounded overflow-hidden">
                                <div class="wrap-img h-100">
                                    <div id="map" class="map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-7">
                            <div
                                class="popup--contacts-offices bg-light-blue p-5 rounded d-flex flex-column justify-content-between">
                                <div>
                                    <div class="spoiler--contacts">
                                        <div class="row row-gap" id="affiliates-container">

                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-lg-8 d-none d-lg-flex">
                                    <div class="col col-xl-6 offset-xl-6">
                                        <button type="button" class="btn btn-block btn-blue" data-toggle="modal"
                                            data-dismiss="modal" aria-label="Close"
                                            data-target="#popup--sign-up-appointment">{{ __('pages.sign_up_for_for_appointment') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-lg-none mt-5">
                                <div class="col">
                                    <button type="button" class="btn btn-block btn-blue" data-toggle="modal"
                                        data-dismiss="modal" aria-label="Close"
                                        data-target="#popup--sign-up-appointment">{{ __('pages.sign_up_for_for_appointment') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal--custom popup--review-thank fade" id="popup--review-thank" data-keyboard="false" tabindex="-1" aria-labelledby="popup--review-thankLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <form class="form-popup--review-thank" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <div class="text-center py-4 py-md-0 my-lg-7">
                                    <div class="i-check mb-5">
                                        <svg>
                                            <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-double-check' }}"></use>
                                        </svg>
                                    </div>
                                    <div class="h4 font-m font-weight-bolder">Дякуємо за відгук!</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal--custom popup--review-thank fade" id="popup--vacancy-thank" data-keyboard="false" tabindex="-1" aria-labelledby="popup--vacancy-thankLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <form class="form-popup--vacancy-thank" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <div class="text-center py-4 py-md-0 my-lg-7">
                                    <div class="i-check mb-5">
                                        <svg>
                                            <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-double-check' }}"></use>
                                        </svg>
                                    </div>
                                    <div class="h4 font-m font-weight-bolder">{{ __('pages.thank_you_your_job_application_has_been_successfully_sent') }}</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal--custom popup--review-thank fade" id="popup--appointment-thank" data-keyboard="false" tabindex="-1" aria-labelledby="popup--appointment-thankLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <form class="form-popup--appointment-thank" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <div class="text-center py-4 py-md-0 my-lg-7">
                                    <div class="i-check mb-5">
                                        <svg>
                                            <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-double-check' }}"></use>
                                        </svg>
                                    </div>
                                    <div class="h4 font-m font-weight-bolder">{{ __('pages.thank_you_our_operator_will_contact_you_shortly') }}</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal--custom popup--review-thank fade" id="popup--appointment-thank" data-keyboard="false" tabindex="-1" aria-labelledby="popup--appointment-thankLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <form class="form-popup--appointment-thank" autocomplete="off">
                        <div class="row">
                            <div class="col">
                                <div class="text-center py-4 py-md-0 my-lg-7">
                                    <div class="i-check mb-5">
                                        <svg>
                                            <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-double-check' }}"></use>
                                        </svg>
                                    </div>
                                    <div class="h4 font-m font-weight-bolder">{{ __('pages.thank_you_our_operator_will_contact_you_shortly') }}</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal--custom popup--interview fade" id="popup--interview" data-keyboard="false" tabindex="-1" aria-labelledby="popup--interview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-5 px-3 py-md-13 px-md-11">
                <div class="modal-body p-0">
                    <form class="form-popup--interview" autocomplete="off"
                        action="{{ route('feedback-vacancy.store') }}">
                                @csrf
                                @method('POST')
                        <div class="row">
                            <div class="col position-static">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <div class="h2 font-m modal-title font-weight-bolder mb-0 pr-8">{{ __('web.sign_up_for_an_interview') }}</div>
                                    <button type="button" class="close" id="close-vacancy-modal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            <svg>
                                                <use xlink:href="{{ Vite::asset(config('app.icons_path')) . '#i-close' }}"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row field-wrap">
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-interview--name">{{ __('web.enter_full_name') }}</label>
                                    <input type="text" id="form-interview--name" name="name" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">{{ __('web.enter_full_name') }}</div>
                                </div>
                                <div id="name_error" class="field--help-info small-txt text-red mb-2"></div>
                            </div>
                            <div class="col-12">
                                <div class="field mb-2">
                                    <label class="control-label mb-2" for="form-interview--phone">{{ __('web.enter_your_phone_number') }}</label>
                                    <input type="tel" id="form-interview--phone" name="phone" class="form-control mb-2">
                                    <div class="field--help-info small-txt text-red mb-2">{{ __('web.enter_your_phone_number') }}</div>
                                </div>
                                <div id="phone_error" class="field--help-info small-txt text-red mb-2"></div>
                            </div>
                            <input type="hidden" id="form-interview--vacancy" name="vacancy">
                            <div class="col-12">
                                <button type="submit" class="btn btn-blue font-weight-bold w-100 mt-2"
                                {{-- data-dismiss="modal" aria-label="Close" --}}
                                >{{ __('web.send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgMBbn1eBSqj8V9kKOn6CqiwTZhoTQP6s&callback=initMap&libraries=marker&v=beta"
        defer></script>
    {{-- <script>
	function initMap() {
		const mapConfigs = [
			{
				elementId: "map",
				center: { lat: 50.45668411158, lng: 30.50518209469263 },
				zoom: 10.1,
				tourStops: [
					{ position: { lat: 51.64334524926339, lng: 32.82858348658312 }, title: "Офіс 1" },
					{ position: { lat: 50.45853652359974, lng: 30.411489795412983 }, title: "Офіс 2" },
				],
			},
			{
				elementId: "map1",
				center: { lat: 50.4501, lng: 30.5234 },
				zoom: 10.0,
				tourStops: [
					{ position: { lat: 50.4501, lng: 30.5234 }, title: "Офіс 1-1" },
					{ position: { lat: 50.45466, lng: 30.5238 }, title: "Офіс 1-2" },
				],
			},
			{
				elementId: "map2",
				center: { lat: 49.839683, lng: 24.029717 },
				zoom: 14.0,
				tourStops: [
					{ position: { lat: 49.839683, lng: 24.029717 }, title: "Офіс 2-1" },
					{ position: { lat: 49.832213, lng: 24.029194 }, title: "Офіс 2-2" },
				],
			},
			{
				elementId: "map3",
				center: { lat: 46.482526, lng: 30.7233095 },
				zoom: 11.0,
				tourStops: [
					{ position: { lat: 46.482526, lng: 30.7233095 }, title: "Офіс 3-1" },
					{ position: { lat: 46.47747, lng: 30.73262 }, title: "Офіс 3-2" },
				],
			},
			{
				elementId: "map4",
				center: { lat: 50.4501, lng: 30.5234 },
				zoom: 10.0,
				tourStops: [
					{ position: { lat: 50.4501, lng: 30.5234 }, title: "Офіс 4-1" },
					{ position: { lat: 50.45466, lng: 30.5238 }, title: "Офіс 4-2" },
				],
			},
		];

		mapConfigs.forEach(({ elementId, center, zoom, tourStops }) => {
			const mapElement = document.getElementById(elementId);
			if (mapElement) {
				const map = new google.maps.Map(mapElement, {
					center,
					zoom,
					disableDefaultUI: true,
					scaleControl: true,
					zoomControl: true,
					scrollwheel: false,
					mapId: "cd19383a34cacd50",
					styles: [
						{
							featureType: "administrative.province",
							elementType: "geometry.stroke",
							stylers: [{ visibility: "off" }],
						},
					],
				});

				const infoWindow = new google.maps.InfoWindow();

				tourStops.forEach(({ position, title }) => {
					const mapMarkerPlace = document.createElement("div");
					mapMarkerPlace.className = "map-marker-place";

					const pinView = new google.maps.marker.PinView();
					const marker = new google.maps.marker.AdvancedMarkerView({
						position,
						map,
						title: `${title}`,
						content: mapMarkerPlace,
					});

					marker.addListener("click", ({ domEvent, latLng }) => {
						const { target } = domEvent;

						infoWindow.close();
						infoWindow.setContent(marker.title);
						infoWindow.open(marker.map, marker);
					});
				});

				map.data.setStyle({
					strokeColor: "#FF0000",
					strokeOpacity: 0.5,
					strokeWeight: 1.5,
					fillColor: "#dce2ff",
					fillOpacity: 0.25,
				});
			}
		});
	}
</script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="{{ asset('styles/js/jquery.min.js') }}"></script>
<script src="{{ asset('styles/js/libs.min.js') }}"></script>
<script src="{{ asset('styles/js/main.min.js') }}"></script> --}}

    @vite(['resources/js/main.js'])

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
                                const closeButton = document.getElementById('close-appointment-modal');

                                if (closeButton) {
                                    closeButton.click();
                                }

                                form.reset();

                                const modalElement = $('#popup--appointment-thank');

                                const modal = new bootstrap.Modal(modalElement);
                                modal.show();

                                setTimeout(() => {
                                    modal.hide();
                                }, 2000);
                            } else {
                                // console.log(data);

                                const errors = data.errors;
                                // console.log(errors);

                                for (const field in errors) {
                                    const fieldElement = form.querySelector(`#${field}_error`);
                                    // console.log(fieldElement);
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify(formData),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            form.reset();

                            const modalElement = $('#popup--appointment-thank');

                            const modal = new bootstrap.Modal(modalElement);
                            modal.show();

                            setTimeout(() => {
                                modal.hide();
                            }, 2000);
                        } else {
                            // console.log(data);

                            const errors = data.errors;
                            // console.log(errors);

                            for (const field in errors) {
                                const fieldElement = form.querySelector(`#${field}_error`);
                                // console.log(fieldElement);
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
    </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const form = document.querySelector('[id="popup--interview"]');
                if (!form) return;
                const vacancyInput = form.querySelector("#form-interview--vacancy");

                document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
                    button.addEventListener("click", function () {
                        const vacancyTitle = this.getAttribute("data-vacancy");
                        vacancyInput.value = vacancyTitle;
                    });
                });

                form.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const formData = {
                        name: form.querySelector('[name="name"]').value,
                        phone: form.querySelector('[name="phone"]').value,
                        vacancy: vacancyInput.value,
                    };

                    fetch('/feedback-vacancy-store', {
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

                                const closeButton = document.getElementById('close-vacancy-modal');

                                if (closeButton) {
                                    closeButton.click();
                                }

                                const modalElement = $('#popup--vacancy-thank');

                                const modal = new bootstrap.Modal(modalElement);
                                modal.show();

                                setTimeout(() => {
                                    modal.hide();
                                }, 2000);
                            } else {
                                // console.log(data);

                                const errors = data.errors;
                                // console.log(errors);

                                for (const field in errors) {
                                    const fieldElement = form.querySelector(`#${field}_error`);
                                    // console.log(fieldElement);
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
        </script>
        <script>
            window.iconsPath = @json(Vite::asset(config('app.icons_path')));
        </script>
    <script>
        transShowMore = @json(__('web.show_more'));
        transShowLess = @json(__('web.show_less'));
        transMoreDetails = @json(__('web.more_details'));
        transCollapse = @json(__('web.collapse'))
    </script>
</body>

</html>

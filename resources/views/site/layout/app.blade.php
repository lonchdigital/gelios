<!DOCTYPE html>
<html lang="uk">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Головна</title>
	<link rel="shortcut icon" href="##" type="image/x-icon" />
	<link rel="stylesheet" href="{{ asset('styles/css/libs.min.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/css/main.min.css') }}">
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
</head>

<body>
	<div class="wrapper">
		<div class="popup-bg-body" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation"></div>
            @include('site.parts.header')
        <main>
            @yield('content')
        </main>
    @include('site.parts.footer')

<div id="btnTop" class="btn btn-arrow-up">
	<svg>
		<use xlink:href="img/icons/icons.svg#i-arrow-small-down"></use>
	</svg>
</div>
	</div>
	<div class="modal modal--custom popup--sign-up-appointment fade" id="popup--sign-up-appointment" data-keyboard="false" tabindex="-1" aria-labelledby="popup--sign-up-appointmentLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content py-5 px-3 py-md-13 px-md-11">
			<div class="modal-body p-0">
				<form class="form-popup--sign-up-appointment" autocomplete="off">
					<div class="row">
						<div class="col position-static">
							<div class="d-flex align-items-start justify-content-between mb-3">
								<div class="h2 font-m modal-title font-weight-bolder mb-0 pr-8">Записатися на прийом</div>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">
										<svg>
											<use xlink:href="img/icons/icons.svg#i-close"></use>
										</svg>
									</span>
								</button>
							</div>
						</div>
					</div>
					<div class="row field-wrap">
						<div class="col-12">
							<div class="field mb-2">
								<label class="control-label mb-2" for="form-sign-up-appointment--name">Вкажіть ПІБ</label>
								<input type="text" id="form-sign-up-appointment--name" class="form-control mb-2">
								<div class="field--help-info small-txt text-red mb-2">Вкажіть ПІБ</div>
							</div>
						</div>
						<div class="col-12">
							<div class="field mb-2">
								<label class="control-label mb-2" for="form-sign-up-appointment--phone">Вкажіть номер телефону</label>
								<input type="tel" id="form-sign-up-appointment--phone" class="form-control mb-2">
								<div class="field--help-info small-txt text-red mb-2">Вкажіть номер телефону</div>
							</div>
						</div>
						<div class="col-12">
							<div class="field mb-2">
								<div class="control-label mb-2">Оберіть фахівця</div>
								<div class="select-wrap">
									<select class="select-choose-specialist--popup">
										<option></option>
										<option value="1">Фахівeць 1</option>
										<option value="2">Фахівeць 2</option>
										<option value="3">Фахівeць 3</option>
										<option value="4">Фахівeць 4</option>
									</select>
								</div>
								<div class="field--help-info small-txt text-red mb-2">Оберіть фахівця</div>
							</div>
						</div>
						<div class="col-12">
							<div class="field mb-2">
								<div class="control-label mb-2">Оберіть клініку</div>
								<div class="select-wrap">
									<select class="select-choose-clinic--popup">
										<option></option>
										<option value="1">Клініка 1</option>
										<option value="2">Клініка 2</option>
										<option value="3">Клініка 3</option>
										<option value="4">Клініка 4</option>
									</select>
								</div>
								<div class="field--help-info small-txt text-red mb-2">Оберіть клініку</div>
							</div>
						</div>
						<div class="col-12">
							<button type="button" class="btn btn-blue font-weight-bold w-100 mt-2" data-dismiss="modal" aria-label="Close">Записатися</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<div class="modal modal--custom popup--contacts fade" id="popup--contacts" data-keyboard="false" tabindex="-1" aria-labelledby="popup--contactsLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<div class="modal-content py-5 px-3 py-md-13 px-md-11">
			<div class="modal-body p-0">
				<div class="row">
					<div class="col position-static">
						<div class="d-flex align-items-start justify-content-between mb-5">
							<div class="h1 font-m modal-title font-weight-bolder mb-0 pr-8">Дніпро</div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									<svg>
										<use xlink:href="img/icons/icons.svg#i-close"></use>
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
						<div class="popup--contacts-offices bg-light-blue p-5 rounded d-flex flex-column justify-content-between">
							<div>
								<div class="spoiler--contacts">
									<div class="row row-gap">
										<div class="col-12 col-xl-6">
											<ul class="list-unstyled mb-0">
												<li>
													<div class="offices-address">вул. Вернадського, 18а</div>
												</li>
												<li>
													<a href="tel:+38 (095) 000-01-50">
														<div class="link-phone">+38 (095) 000-01-50</div>
													</a>
												</li>
												<li>
													<a href="tel:+38 (050) 325-62-93">
														<div class="link-phone">+38 (050) 325-62-93</div>
													</a>
												</li>
												<li>
													<div class="offices-time">08:00 - 20:00</div>
												</li>
												<li>
													<a href="mailto:helioscentr@gmail.com">
														<div class="offices-email">helioscentr@gmail.com</div>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-12 col-xl-6">
											<ul class="list-unstyled mb-0">
												<li>
													<div class="offices-address">вул. Вернадського, 18а</div>
												</li>
												<li>
													<a href="tel:+38 (095) 000-01-50">
														<div class="link-phone">+38 (095) 000-01-50</div>
													</a>
												</li>
												<li>
													<a href="tel:+38 (050) 325-62-93">
														<div class="link-phone">+38 (050) 325-62-93</div>
													</a>
												</li>
												<li>
													<div class="offices-time">08:00 - 20:00</div>
												</li>
												<li>
													<a href="mailto:helioscentr@gmail.com">
														<div class="offices-email">helioscentr@gmail.com</div>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-12 col-xl-6">
											<ul class="list-unstyled mb-0">
												<li>
													<div class="offices-address">вул. Вернадського, 18а</div>
												</li>
												<li>
													<a href="tel:+38 (095) 000-01-50">
														<div class="link-phone">+38 (095) 000-01-50</div>
													</a>
												</li>
												<li>
													<a href="tel:+38 (050) 325-62-93">
														<div class="link-phone">+38 (050) 325-62-93</div>
													</a>
												</li>
												<li>
													<div class="offices-time">08:00 - 20:00</div>
												</li>
												<li>
													<a href="mailto:helioscentr@gmail.com">
														<div class="offices-email">helioscentr@gmail.com</div>
													</a>
												</li>
											</ul>
										</div>
										<div class="col-12 col-xl-6">
											<ul class="list-unstyled mb-0">
												<li>
													<div class="offices-address">вул. Вернадського, 18а</div>
												</li>
												<li>
													<a href="tel:+38 (095) 000-01-50">
														<div class="link-phone">+38 (095) 000-01-50</div>
													</a>
												</li>
												<li>
													<a href="tel:+38 (050) 325-62-93">
														<div class="link-phone">+38 (050) 325-62-93</div>
													</a>
												</li>
												<li>
													<div class="offices-time">08:00 - 20:00</div>
												</li>
												<li>
													<a href="mailto:helioscentr@gmail.com">
														<div class="offices-email">helioscentr@gmail.com</div>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-lg-8 d-none d-lg-flex">
								<div class="col col-xl-6 offset-xl-6">
									<button type="button" class="btn btn-block btn-blue" data-toggle="modal" data-dismiss="modal" aria-label="Close">Записатися на прийом</button>
								</div>
							</div>
						</div>
						<div class="row d-lg-none mt-5">
							<div class="col">
								<button type="button" class="btn btn-block btn-blue" data-toggle="modal" data-dismiss="modal" aria-label="Close">Записатися на прийом</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgMBbn1eBSqj8V9kKOn6CqiwTZhoTQP6s&callback=initMap&libraries=marker&v=beta" defer></script>
<script>
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

</script>

	<script src="{{ asset('styles/js/jquery.min.js') }}"></script>
<script src="{{ asset('styles/js/libs.min.js') }}"></script>
<script src="{{ asset('styles/js/main.min.js') }}"></script>
</body>

</html>
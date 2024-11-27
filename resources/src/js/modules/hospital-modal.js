$('.contact-details').on('click', function () {
    var city = $(this).data('city');

    $('#popup--contacts #modal-city').text(city);

    const affiliates = [
        $(this).data('first'),
        $(this).data('second'),
        $(this).data('third'),
        $(this).data('fourth'),
    ].filter(Boolean);

    $('#popup--contacts #first-address').text($(this).data('first').address);
    $('#popup--contacts #first-phone1').text($(this).data('first').first_phone);
    $('#popup--contacts #first-phone2').text($(this).data('first').second_phone);
    $('#popup--contacts #first-hours').text($(this).data('first').hours);
    $('#popup--contacts #first-email').text($(this).data('first').email);
    $('#popup--contacts #first-longitude').text($(this).data('first').longitude);
    $('#popup--contacts #first-latitude').text($(this).data('first').latitude);

    $('#popup--contacts #second-address').text($(this).data('second').address);
    $('#popup--contacts #second-phone1').text($(this).data('second').first_phone);
    $('#popup--contacts #second-phone2').text($(this).data('second').second_phone);
    $('#popup--contacts #second-hours').text($(this).data('second').hours);
    $('#popup--contacts #second-email').text($(this).data('second').email);

    $('#popup--contacts #third-address').text($(this).data('third').address);
    $('#popup--contacts #third-phone1').text($(this).data('third').first_phone);
    $('#popup--contacts #third-phone2').text($(this).data('third').second_phone);
    $('#popup--contacts #third-hours').text($(this).data('third').hours);
    $('#popup--contacts #third-email').text($(this).data('third').email);

    $('#popup--contacts #fourth-address').text($(this).data('fourth').address);
    $('#popup--contacts #fourth-phone1').text($(this).data('fourth').first_phone);
    $('#popup--contacts #fourth-phone2').text($(this).data('fourth').second_phone);
    $('#popup--contacts #fourth-hours').text($(this).data('fourth').hours);
    $('#popup--contacts #fourth-email').text($(this).data('fourth').email);

    initMap(affiliates);
});

function initMap(affiliates) {
    console.log(affiliates[0].latitude);
    const mapConfigs = [
        {
            elementId: "map",
            center: { lat: 50.45668411158, lng: 30.50518209469263 },
            zoom: 7,
            tourStops: affiliates
                .filter(affiliate =>
                    affiliate.latitude &&
                    affiliate.longitude &&
                    affiliate.address // Перевіряємо, щоб всі дані були не порожні
                )
                .map(affiliate => ({
                    position: {
                        lat: parseFloat(affiliate.latitude),
                        lng: parseFloat(affiliate.longitude)
                    },
                    title: affiliate.address
                })),
        },

    ];

    mapConfigs.forEach(({ elementId, zoom, tourStops }) => {
        const mapElement = document.getElementById(elementId);
        if (mapElement) {
            const bounds = new google.maps.LatLngBounds();

            const map = new google.maps.Map(mapElement, {
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
                bounds.extend(position);

                const mapMarkerPlace = document.createElement("div");
                mapMarkerPlace.className = "map-marker-place";

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

            map.fitBounds(bounds);

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

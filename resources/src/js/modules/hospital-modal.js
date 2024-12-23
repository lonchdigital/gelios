$('.contact-details').on('click', function () {
    var city = $(this).data('city');
    $('#popup--contacts #modal-city').text(city);

    const affiliates = [
        $(this).data('first'),
        $(this).data('second'),
        $(this).data('third'),
        $(this).data('fourth'),
    ].filter(Boolean);

    if (affiliates[0]) {
        if (affiliates[0]?.address) {
            $('#popup--contacts #first-address').html(affiliates[0].address).show();
        } else {
            $('#popup--contacts #first-address').hide();
        }

        if (affiliates[0]?.first_phone) {
            $('#popup--contacts #first-phone1').text(affiliates[0].first_phone).show();
            $('#popup--contacts #first-phone1').parent('a').attr('href', 'tel:'+affiliates[0].first_phone);
        } else {
            $('#popup--contacts #first-phone1').hide();
        }

        if (affiliates[0]?.second_phone) {
            $('#popup--contacts #first-phone2').text(affiliates[0].second_phone).show();
            $('#popup--contacts #first-phone2').parent('a').attr('href', 'tel:'+affiliates[0].second_phone);
        } else {
            $('#popup--contacts #first-phone2').hide();
        }

        if (affiliates[0]?.hours) {
            $('#popup--contacts #first-hours').html(affiliates[0].hours).show();
        } else {
            $('#popup--contacts #first-hours').hide();
        }

        if (affiliates[0]?.email) {
            $('#popup--contacts #first-email').text(affiliates[0].email).show();
            $('#popup--contacts #first-email').parent('a').attr('href', 'mailto:'+affiliates[0].email);
        } else {
            $('#popup--contacts #first-email').hide();
        }

        if (affiliates[0]?.latitude) {
            $('#popup--contacts #first-latitude').text(affiliates[0].latitude);
        }

        if (affiliates[0]?.longitude) {
            $('#popup--contacts #first-longitude').text(affiliates[0].longitude);
        }
    }

    if (affiliates[1]) {
        if (affiliates[1]?.address) {
            $('#popup--contacts #second-address').html(affiliates[1].address).show();
        } else {
            $('#popup--contacts #second-address').hide();
        }

        if (affiliates[1]?.first_phone) {
            $('#popup--contacts #second-phone1').text(affiliates[1].first_phone).show();
            $('#popup--contacts #second-phone1').parent('a').attr('href', 'tel:'+affiliates[1].first_phone);
        } else {
            $('#popup--contacts #second-phone1').hide();
        }

        if (affiliates[1]?.second_phone) {
            $('#popup--contacts #second-phone2').text(affiliates[1].second_phone).show();
            $('#popup--contacts #second-phone2').parent('a').attr('href', 'tel:'+affiliates[1].second_phone);
        } else {
            $('#popup--contacts #second-phone2').hide();
        }

        if (affiliates[1]?.hours) {
            $('#popup--contacts #second-hours').html(affiliates[1].hours).show();
        } else {
            $('#popup--contacts #second-hours').hide();
        }

        if (affiliates[1]?.email) {
            $('#popup--contacts #second-email').text(affiliates[1].email).show();
            $('#popup--contacts #second-email').parent('a').attr('href', 'mailto::'+affiliates[1].email);
        } else {
            $('#popup--contacts #second-email').hide();
        }

        if (affiliates[1]?.latitude) {
            $('#popup--contacts #second-latitude').text(affiliates[1].latitude);
        }

        if (affiliates[1]?.longitude) {
            $('#popup--contacts #second-longitude').text(affiliates[1].longitude);
        }
    }

    if (affiliates[2]) {
        if (affiliates[2]?.address) {
            $('#popup--contacts #third-address').html(affiliates[2].address).show();
        } else {
            $('#popup--contacts #third-address').hide();
        }

        if (affiliates[2]?.first_phone) {
            $('#popup--contacts #third-phone1').text(affiliates[2].first_phone).show();
            $('#popup--contacts #third-phone1').parent('a').attr('href', 'tel:'+affiliates[2].first_phone);
        } else {
            $('#popup--contacts #third-phone1').hide();
        }

        if (affiliates[2]?.second_phone) {
            $('#popup--contacts #third-phone2').text(affiliates[2].second_phone).show();
            $('#popup--contacts #third-phone2').parent('a').attr('href', 'tel:'+affiliates[2].second_phone);
        } else {
            $('#popup--contacts #third-phone2').hide();
        }

        if (affiliates[2]?.hours) {
            $('#popup--contacts #third-hours').html(affiliates[2].hours).show();
        } else {
            $('#popup--contacts #third-hours').hide();
        }

        if (affiliates[2]?.email) {
            $('#popup--contacts #third-email').text(affiliates[2].email).show();
            $('#popup--contacts #third-email').parent('a').attr('href', 'mailto:'+affiliates[2].email);
        } else {
            $('#popup--contacts #third-email').hide();
        }

        if (affiliates[2]?.latitude) {
            $('#popup--contacts #third-latitude').text(affiliates[2].latitude);
        }

        if (affiliates[2]?.longitude) {
            $('#popup--contacts #third-longitude').text(affiliates[2].longitude);
        }
    }

    if (affiliates[3]) {
        if (affiliates[3]?.address) {
            $('#popup--contacts #fourth-address').html(affiliates[3].address).show();
        } else {
            $('#popup--contacts #fourth-address').hide();
        }

        if (affiliates[3]?.first_phone) {
            $('#popup--contacts #fourth-phone1').text(affiliates[3].first_phone).show();
            $('#popup--contacts #fourth-phone1').parent('a').attr('href', 'tel:'+affiliates[3].first_phone);
        } else {
            $('#popup--contacts #fourth-phone1').hide();
        }

        if (affiliates[3]?.second_phone) {
            $('#popup--contacts #fourth-phone2').text(affiliates[3].second_phone).show();
            $('#popup--contacts #fourth-phone2').parent('a').attr('href', 'tel:'+affiliates[3].second_phone);
        } else {
            $('#popup--contacts #fourth-phone2').hide();
        }

        if (affiliates[3]?.hours) {
            $('#popup--contacts #fourth-hours').html(affiliates[3].hours).show();
        } else {
            $('#popup--contacts #fourth-hours').hide();
        }

        if (affiliates[3]?.email) {
            $('#popup--contacts #fourth-email').text(affiliates[3].email).show();
            $('#popup--contacts #fourth-email').parent('a').attr('href', 'mailto:'+affiliates[3].email);
        } else {
            $('#popup--contacts #fourth-email').hide();
        }

        if (affiliates[3]?.latitude) {
            $('#popup--contacts #fourth-latitude').text(affiliates[3].latitude);
        }

        if (affiliates[3]?.longitude) {
            $('#popup--contacts #fourth-longitude').text(affiliates[3].longitude);
        }
    }

    initMap(affiliates);
});

function initMap(affiliates) {
    const mapConfigs = [
        {
            elementId: "map",
            center: { lat: 50.45668411158, lng: 30.50518209469263 },
            zoom: 7,
            tourStops: affiliates
                .filter(affiliate =>
                    affiliate.latitude &&
                    affiliate.longitude &&
                    affiliate.address
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

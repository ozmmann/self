var geocoder;
var autocomplete;
var map;
var marker;
var currentInput;
var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150, 50)});
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(50.529, 30.517);
    var mapOptions = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        rotateControl: false,
    };
    map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
    google.maps.event.addListener(map, 'click', function () {
        infowindow.close();
    });

    $('.address-row').find('.address').each(function () {
        var id = $(this).attr('id');
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById(id)),
            {types: ['geocode']});

        autocomplete.addListener('place_changed', function () {
            codeAddress(id);
        });

        codeAddress(id);
    });
}

function clone(obj) {
    if (obj == null || typeof(obj) != 'object') return obj;
    var temp = new obj.constructor();
    for (var key in obj) temp[key] = clone(obj[key]);
    return temp;
}

var getLatLng = function(lat, lng) {
    return new google.maps.LatLng(lat, lng);
};

var markers = {};

function geocodePosition(pos, inputId) {
    currentInput = inputId;
    geocoder.geocode({
        latLng: pos
    }, function (responses) {
        if (responses && responses.length > 0) {
            marker.formatted_address = responses[0].formatted_address;
            $('#preview_' + inputId).find('.preview_address').text(marker.formatted_address);
            fillInAddress(inputId, responses[0]);
        } else {
            marker.formatted_address = 'Адрес не понятен';
        }
        infowindow.setContent(marker.formatted_address);
        // infowindow.open(map, marker);

        document.getElementById(currentInput).value = marker.formatted_address;
    });
}

function codeAddress(inputId) {
    var address = document.getElementById(inputId).value;

    if(!address){
        return;
    }

    $('#preview_' + inputId).find('.preview_address').text(address);

    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.fitBounds(results[0].geometry.viewport);

            marker = markers[inputId];

            if(!marker) {
                var pinColor = Math.floor(Math.random() * 16777215).toString(16);
                var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(10, 34));
                var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                    new google.maps.Size(40, 37),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(12, 35));

                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: results[0].geometry.location,
                    icon: pinImage,
                    shadow: pinShadow,
                    id: 'marker_' + inputId
                });
            }else {
                marker.setPosition(results[0].geometry.location);
            }

            markers[inputId] = marker;


            //
            // var bounds = new google.maps.LatLngBounds();
            // for (marker in markers) {
                // bounds.extend(marker.getPosition());
            // }

            // map.fitBounds(bounds);
            // map.panToBounds(bounds);

            google.maps.event.addListener(marker, 'dragend', function () {
                // updateMarkerStatus('Drag ended');
                // fillInAddress(inputId, marker);
                geocodePosition(this.getPosition(), inputId);
            });
            google.maps.event.addListener(marker, 'click', function () {
                if (marker.formatted_address) {
                    infowindow.setContent(marker.formatted_address);
                } else {
                    infowindow.setContent(address);
                }
                infowindow.open(map, marker);
            });

            fillInAddress(inputId, results[0]);

        }
    });
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}

function fillInAddress(addressId, place) {
    var cityId = "city_" + addressId;

    document.getElementById(cityId).value = '';

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (addressType == 'locality') {
            var val = place.address_components[i]['long_name'];
            document.getElementById(cityId).value = val;
        }
    }
}

$(document).ready(function ($) {
    initialize();
});
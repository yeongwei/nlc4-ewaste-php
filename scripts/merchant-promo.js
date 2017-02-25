$(document).ready(function () {
    $("#map-actual").css({
        "height": $(window).height() + "px",
        "width": $(window).width() + "px"
    });
    initMap(destinationLatLng);
    
});

// navigate(directionsService, directionsDisplay, "3.1366612,101.6217609");

function initMap(destination) {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById("map-actual"), {
        zoom: 6,
        center: {lat: 3.1390, lng: 101.6869}
    });
    directionsDisplay.setMap(map);
    navigate(directionsService, directionsDisplay, destination)
}

function calculateAndDisplayRoute(directionsService, directionsDisplay, originLatLng, destLatLng) {
    directionsService.route({
        origin: originLatLng,
        destination: destLatLng,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function navigate(directionsService, directionsDisplay, destination) {
    if (navigator) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(response) {
                var lat = response.coords.latitude;
                var lng = response.coords.longitude;
                calculateAndDisplayRoute(directionsService, directionsDisplay,
                        lat + "," + lng, destination)
            }, function(response) {
                navigateWithCurrentIp(directionsService, directionsDisplay,
                        destination);
            });
        } else {
            navigateWithCurrentIp(directionsService, directionsDisplay,
                    destination);
        }
    } else {
        navigateWithCurrentIp(directionsService, directionsDisplay, destination);
    }
}

function navigateWithCurrentIp(directionsService, directionsDisplay,
        destination) {
    $.get("https://ipinfo.io/json", function(response) {
        console.log(response.loc)
        calculateAndDisplayRoute(directionsService, directionsDisplay,
                response.loc, destination)
    }, "jsonp");
}
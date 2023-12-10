$(document).ready(function() {
    function storePosition(position) {
        var googleLocation = localStorage.getItem('googleLocation');
        var localLat = localStorage.getItem('lat');
        var localLng = localStorage.getItem('lng');
    }

    var input = document.getElementById("address");
    var autocomplete;
    (autocomplete = new google.maps.places.Autocomplete(input)), {
        types: ["geocode"],
    };

    google.maps.event.addListener(autocomplete, "place_changed", function() {
        var place = autocomplete.getPlace();

        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();

        $("#lat").val(latitude);
        $("#lng").val(longitude);
        localStorage.setItem('lat', latitude)
        localStorage.setItem('lng', longitude)
    });


});
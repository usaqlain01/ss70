$(document).ready(function(){
    var lat = $("input#lat").val();
    var lon = $("input#lon").val();

    function initialize() {
        var mapProp = {
            center:new google.maps.LatLng(lat,lon),
            zoom:2,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

});



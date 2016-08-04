// Way 2 for loading plain google map, for way 1 see static_map.js
$(document).ready(function(){
    (function(window, google, mapster) {
        // Refactored out Map Options, These are coming from map_options_alpha.js
        var options = mapster.MAP_OPTIONS,
        target_div = document.getElementById('map-canvas'),
        map = mapster.create(target_div, options);

        // Dynamically changing map options
        //map.gMap.setZoom(10); This is bad practice. Check Mapster.js prototype function to acquire this.

        map.zoom(2); // Possible due to prototype function in Mapster.js



    }(window, google, window.Mapster || (window.Mapster = {})));
});
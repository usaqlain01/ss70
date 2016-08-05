// Helper class to facilitate map creation. see custom_map.js, to see how to use it.
(function (window, google) {
    
    var Mapster = (function () {
        function Mapster(target, options) {
            this.gMap = new google.maps.Map(target, options);
        }
        Mapster.prototype = {
            zoom: function (level) {
                if (level) {
                    this.gMap.setZoom(level);
                } else {
                    this.gMap.getZoom();
                }

            }
        };
        return Mapster;
    }());
    
    Mapster.create = function (target, options) {
        return new Mapster(target, options);
    };

    window.Mapster = Mapster;

}(window, google));
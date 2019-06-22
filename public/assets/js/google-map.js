$(document).ready(function() {

    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 13,

            // Disable scroll-wheel zoom
            scrollwheel: false,

            draggable: false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(40.7127, -74.0059), 

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#005f91"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#008cca"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#00b7de"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#00ace9"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#00ace9"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#009ed9"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#006792"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#008cca"}]}]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using out element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        
    }

}); // End document.ready
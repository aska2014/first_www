@if(isset($sliderItems) && ! $sliderItems->isEmpty())
<section id="slider_wrapper" class="slider_wrapper full_page_photo">
    <div id="main_flexslider" class="flexslider">
        <ul class="slides">
            @foreach($sliderItems as $item)
            <li class="item" style="background-image: url({{ $item->image->url }})">
                <div class="container">
                    <div class="carousel-caption animated bounceInUp">
                        <h1>{{ $item->title }}</h1>

                        <p class="lead skincolored">{{ $item->description }}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@elseif(isset($map))
<div class="full_page_photo">
    <div id="map"></div>
</div>


<script>
    (function () {

        "use strict";

// When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // The latitude and longitude to center the map (always required)
            // You can find it easily at http://universimmedia.pagesperso-orange.fr/geo/loc.htm
            var myLatlng = new google.maps.LatLng({{ $map->center->latitude }}, {{ $map->center->longitude }}); // London

            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 4,
                // Disable scrollwheel zooming on the map
                scrollwheel: false,
                center: myLatlng,

                // How you would like to style the map.
                // This is where you would paste any style. For example paste a style found on Snazzy Maps.
                styles: [
                    {'featureType': 'water', 'stylers': [
                        {'visibility': 'on'},
                        {'color': '#428BCA'}
                    ]},
                    {'featureType': 'landscape', 'stylers': [
                        {'color': '#f2e5d4'}
                    ]},
                    {'featureType': 'road.highway', 'elementType': 'geometry', 'stylers': [
                        {'color': '#c5c6c6'}
                    ]},
                    {'featureType': 'road.arterial', 'elementType': 'geometry', 'stylers': [
                        {'color': '#e4d7c6'}
                    ]},
                    {'featureType': 'road.local', 'elementType': 'geometry', 'stylers': [
                        {'color': '#fbfaf7'}
                    ]},
                    {'featureType': 'poi.park', 'elementType': 'geometry', 'stylers': [
                        {'color': '#c5dac6'}
                    ]},
                    {'featureType': 'administrative', 'stylers': [
                        {'visibility': 'on'},
                        {'lightness': 33}
                    ]},
                    {'featureType': 'road'},
                    {'featureType': 'poi.park', 'elementType': 'labels', 'stylers': [
                        {'visibility': 'on'},
                        {'lightness': 20}
                    ]},
                    {},
                    {'featureType': 'road', 'stylers': [
                        {'lightness': 20}
                    ]}
                ]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen up in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using out element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            @foreach($map->locations as $location)

            // Put a marker at the center of the map
            var marker{{ $location->id }} = new google.maps.Marker({
                position: new google.maps.LatLng({{ $location->latitude }}, {{ $location->longitude }}),
                map: map,
            });
            // Listen for marker clicks
            google.maps.event.addListener(marker{{ $location->id }}, 'click', function() {
                selectMarker(marker{{ $location->id }}, "{{ $location->id }}");
            });

            @endforeach

            selectMarker(marker{{ $location->id }}, "{{ $location->id }}");
        }

        function selectMarker(marker, id) {

            $(".marker-divs").hide();
            $("#marker-div-" + id).show();
        }
    }())
</script>

@elseif(isset($page))
<div class="full_page_photo no_photo">
    <div id="map"></div>
    <div class="container">
        <div class="hgroup">
            <div class="hgroup_title animated bounceInUp skincolored">
                <div class="container">
                    <h1 class="">{{ $page->title }}</h1>
                </div>
            </div>
            <div class="hgroup_subtitle animated bounceInUp ">
                <div class="container">
                    <p>{{ $page->sub_title }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
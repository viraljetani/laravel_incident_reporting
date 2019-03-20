@extends('layouts.app')

@section('template_title')
	Home
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
    <div class="col-12" class="map-canvas-container">
        @if(config('settings.googleMapsAPIStatus'))
            <div id="map-canvas"></div>                                
        @endif
    </div>
@endsection

@section('footer_scripts')
@if(config('settings.googleMapsAPIStatus'))

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<script type="text/javascript">

    function google_maps_geocode_and_map() {

        //var geocoder = new google.maps.Geocoder();
        //var address = '{{ $posts[0]->location }}';

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 3,
          center: {lat: -13.2543, lng: 34.3015}
        });

        // Create an array of alphabetical characters used to label the markers.
        //var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            //label: labels[i % labels.length]
          });
        });
        console.log(markers);
        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      
    }
     var locations = [
        {lat: -31.563910, lng: 147.154312},
        {lat: -33.718234, lng: 150.363181},
        {lat: -33.727111, lng: 150.371124},
        {lat: -33.848588, lng: 151.209834},
        {lat: -33.851702, lng: 151.216968},
        {lat: -34.671264, lng: 150.863657},
        {lat: -35.304724, lng: 148.662905},
        {lat: -36.817685, lng: 175.699196},
        {lat: -36.828611, lng: 175.790222},
        {lat: -37.750000, lng: 145.116667},
        {lat: -37.759859, lng: 145.128708},
        {lat: -37.765015, lng: 145.133858},
        {lat: -37.770104, lng: 145.143299},
        {lat: -37.773700, lng: 145.145187},
        {lat: -37.774785, lng: 145.137978},
        {lat: -37.819616, lng: 144.968119},
        {lat: -38.330766, lng: 144.695692},
        {lat: -39.927193, lng: 175.053218},
        {lat: -41.330162, lng: 174.865694},
        {lat: -42.734358, lng: 147.439506},
        {lat: -42.734358, lng: 147.501315},
        {lat: -42.735258, lng: 147.438000},
        {lat: -43.999792, lng: 170.463352},
      ];
        var locations1 = [];

        var geocoder = new google.maps.Geocoder();
        @if(isset($posts)) 
            @foreach($posts as $key => $post)
            var address = '{{ $post->location }}';
			      geocoder.geocode( { 'address': address}, function(results, status) {

				  if (status == google.maps.GeocoderStatus.OK) {
					var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                }

              var latlong = "{lat: latitude, lng: longitude},";
              var singleObj = {}
                singleObj['lat'] = latitude;
                singleObj['long'] = longitude;

              locations1.push(singleObj);
            });
            @endforeach
          @endif

            /* //console.log(locations1); 
            var listOfObjects = [];
            var a = ["car", "bike", "scooter"];
            a.forEach(function(entry) {
                var singleObj = {}
                singleObj['lat'] = 'vehicle';
                singleObj['long'] = entry;
                listOfObjects.push(singleObj);
            }); */
           

            console.log(locations);

    google_maps_geocode_and_map();

</script>

		{{-- <script type="text/javascript">

		function google_maps_geocode_and_map() {

			var geocoder = new google.maps.Geocoder();
			var address = '{{ $posts[0]->location }}';

			geocoder.geocode( { 'address': address}, function(results, status) {

				if (status == google.maps.GeocoderStatus.OK) {

					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();

					// SHOW LATITUDE AND LONGITUDE
					document.getElementById('latitude').innerHTML += latitude;
					document.getElementById('longitude').innerHTML += longitude;

					// CHECK IF HTML DOM CONTAINER IS FOUND
					if (document.getElementById('map-canvas')){

						function getMap() {

						    // Coordinates to center the map
						    var LatitudeAndLongitude = new google.maps.LatLng(latitude,longitude);

							var mapOptions = {
								scrollwheel: true,
								disableDefaultUI: true,
								draggable: true,
								zoom: 10,
								center: LatitudeAndLongitude,
								mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
							};

							var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

						  	// MARKER
						    var marker = new google.maps.Marker({
						        map: map,
						        //icon: "",
						        title: '<strong>Name</strong> <br />  Last Name',
						        position: map.getCenter()
						    });

						    // INFO WINDOW
							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent('<strong>My name</strong> <br />  myemail');

						    infowindow.open(map, marker);
							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map, marker);
							});

						}

						// ATTACH MAP TO DOM HTML ELEMENT
						google.maps.event.addDomListener(window, 'load', getMap);

					}

				}

			});

		}

		google_maps_geocode_and_map();

	</script> --}}
	@endif
@endsection
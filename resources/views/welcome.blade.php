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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin="" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/example/screen.css" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js" integrity="sha512-WXoSHqw/t26DszhdMhOXOkI7qCiv5QWXhH9R7CgvgZMHz1ImlkVQ3uNsiQKu5wwbbxtPzFXd1hK4tzno2VqhpA==" crossorigin=""></script>

<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<!--script src="https://leaflet.github.io/Leaflet.markercluster/example/realworld.388.js"></script-->



<script type="text/javascript">

    @if(isset($posts)) 
        var addressPoints = [];
        var geocoder = new google.maps.Geocoder();
        @foreach($posts as $key => $post)
        var address = '{{ $post->location }}';
                geocoder.geocode( { 'address': address}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
            }

            //var latlong = "{lat: latitude, lng: longitude},";
            /* var singleObj = {}
            singleObj['lat'] = latitude;
            singleObj['long'] = longitude; */
            var cords = [latitude,longitude];
            addressPoints.push(cords);
        });
        @endforeach
        console.log(addressPoints);
    @endif
/* var addressPoints = [
[-37.8210922667, 175.2209316333],
[-37.8210819833, 175.2213903167],
[-37.8210881833, 175.2215004833],
[-37.8211946833, 175.2213655333],
[-37.8209458667, 175.2214051333],
[-37.8208292333, 175.2214374833, "<h1>title</h1>"],

[-37.8194342167, 175.22322975, "9"]
]; */
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
        }),
        latlng = L.latLng(-13.2543, 34.3015);

    var map = L.map('map-canvas', {center: latlng, zoom: 6, layers: [tiles]});

    var markers = L.markerClusterGroup();
    
    for (var i = 0; i < addressPoints.length; i++) {
        var a = addressPoints[i];
        var title = a[2];
        var marker = L.marker(new L.LatLng(a[0], a[1]), { title: title });
        marker.bindPopup(title);
        markers.addLayer(marker);
    }

    map.addLayer(markers);

</script>
@endsection
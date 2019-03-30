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
    //var addressPoints;
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
        }),
        latlng = L.latLng(-13.2543, 34.3015);

    var map = L.map('map-canvas', {center: latlng, zoom: 8, layers: [tiles]});
    var points = function () {
        var tmp = null;
        $.ajax({
        type: "GET",
        global:false,
        async: false,
        url: "{{ route('maps.data')}}",
        datatype: "json",
        success: function(data) {
            
                tmp = data;
                //alert(tmp);
            }
        });
        return tmp;
    }();
    var addressPoints = JSON.parse(points);
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
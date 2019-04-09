@extends('layouts.master')

@section('template_title')
	Home
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')

 <!-- Begin Page Content -->
 <div class="container-fluid p-1">

        <!-- Content Row -->
        <div class="row">
            <div class=""></div>
                <div class="col-12 p-0 map-canvas-container">
                    @if(config('settings.googleMapsAPIStatus'))
                        <div id="map-canvas"></div>                                
                    @endif
                    <div class="fixed-bottom position-absolute w-100 bg-dark d-none d-sm-block ">
                        
                        <nav class="navbar navbar-expand navbar-light bg-white mb-0 static-bottom shadow">
                            <!-- Bottom Navbar -->
                            <ul class="navbar-nav ml-auto">
                    
                                
                                <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link" href="{{route('posts.data')}}">
                                    <i class="fas fa-calendar text-gray-300"></i>
                                    Total Incidents
                                    <span class="badge badge-success badge-counter">@if($posts){{$posts->count()}}@endif</span>
                                </a>
                                
                                </li>
                                
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link" href="{{route('organizations')}}">
                                        <i class="fas fa-building text-gray-300"></i>
                                        Civil Society Organizations
                                        <span class="badge badge-warning badge-counter">6</span>
                                    </a>
                                
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link" href="{{route('reports.incident.victims')}}">
                                        <i class="fas fa-users text-gray-300"></i>
                                        Total Victims
                                        <span class="badge badge-info badge-counter">@if($posts)@php echo $posts->pluck('male_victims')->sum()+$posts->pluck('female_victims')->sum(); @endphp @endif</span>
                                    </a>
                                
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-map text-gray-300"></i>
                                        Total Districts
                                        <span class="badge badge-danger badge-counter">13</span>
                                    </a>
                                
                                </li>
                        
                            </ul>
                        </nav>

                    </div>
                    
                </div>
        </div>

</div>
        <!-- /.container-fluid -->
    

<!-- Modal -->
<div class="modal fade hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Districts Monitored - Chisankho2019</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Lilongwe</li>
                    <li>Nsanje</li>
                    <li>Chikwawa</li>
                    <li>Zomba</li>
                    <li>Mangochi</li>
                    <li>Koranga</li>
                    <li>Mwanza</li>
                    <li>Kasungu</li>
                    <li>Rumphi</li>
                    <li>Mulanje</li>
                    <li>Salima</li>
                    <li>Blantyre</li>
                    <li>Chiradzulu</li>
            </ol>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
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
        latlng = L.latLng(-13.9626, 33.7741);

    var map = L.map('map-canvas', {center: latlng, zoom: 9, layers: [tiles]});
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
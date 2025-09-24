@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #canvas_map{
            height: 300px;
            width: 300px;
        }
    </style>

@endsection
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{ $menu_name }} Management</h4>
                <h6>Add/Update {{ $menu_name }}</h6>
            </div>
        </div>
        
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ url('/store/'.$edit->id.'/update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="store_name" value="{{ $edit->store_name }}">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" id="lokasi" name="store_location" value="{{ $edit->store_location }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Map</label>
                                    <div id="canvas_map"></div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Latitude</label>
                                        {{-- <input type="text" name="latitude" id="latitude" disabled> --}}
                                        <input type="text" name="store_latitude" id="latitude" value="{{ $edit->store_latitude }}">
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                        {{-- <input type="text" name="longitude" id="longitude" disabled> --}}
                                        <input type="text" name="store_longitude" id="longitude" value="{{ $edit->store_longitude }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <button class="btn btn-cancel">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>
</div>

@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>    
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        var init_lat = {{ $edit->store_latitude }};
        var init_lng = {{ $edit->store_longitude }};

        var map = L.map('canvas_map').setView([init_lat, init_lng], 13);

        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        var marker = L.marker([init_lat, init_lng], {
            draggable: true,
        }).addTo(map);

        function onMapClick(e){
            var latitude = document.querySelector("[id=latitude]")
            var longitude = document.querySelector("[id=longitude]")

            var lat = e.latlng.lat
            var lng = e.latlng.lng

            if(!marker){
                marker = L.marker(e.latlng).addTo(map)
            }else{
                marker.setLatLng(e.latlng)
            }

            // console.log(lat)
            latitude.value = lat
            longitude.value = lng
        }
        map.on('click', onMapClick)
    </script>
@endpush
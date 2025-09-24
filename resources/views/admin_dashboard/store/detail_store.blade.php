@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #canvas_map{
            height: 400px;
            width: 880px;
        }
    </style>
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>{{ $menu_name }} Details</h4>
                    <h6>Full details of a {{ $menu_name }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="bar-code-view">
                                <img src="{{asset('dashboard_admin/assets/img/barcode1.png')}}" alt="barcode">
                                <a class="printimg">
                                    <img src="{{asset('dashboard_admin/assets/img/icons/printer.svg')}}" alt="print">
                                </a>
                            </div> --}}
                            <div class="productdetails">
                                <div id="canvas_map"></div>
                            </div>
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Nama</h4>
                                        <h6>{{ $detail->store_name }}</h6>
                                    </li>
                                    <li>
                                        <h4>Lokasi</h4>
                                        <h6>{{ $detail->store_location }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme product-slide">
                                    <div class="slider-product">
                                        <img src="{{asset('dashboard_admin/assets/img/product/product69.jpg')}}" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                    <div class="slider-product">
                                        <img src="{{asset('dashboard_admin/assets/img/product/product69.jpg')}}" alt="img">
                                        <h4>macbookpro.jpg</h4>
                                        <h6>581kb</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>


@endsection
@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        var lat = {{ $detail->store_latitude }};
        var lng = {{ $detail->store_longitude }};
        // console.log(lat);
        var map = L.map('canvas_map').setView([lat, lng], 13);

        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        var marker = L.marker([lat, lng], {
            draggable: false,
        }).addTo(map);
    </script>
@endpush
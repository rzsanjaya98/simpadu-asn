@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
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
   <div class="row">
      <div class="col-md-12">
         <div class="card">
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
            <div class="card-header">
               <h5 class="card-title">Add/Update Form</h5>
            </div>
            <div class="card-body">
               <h5 class="card-title">Personal Information</h5>
               <form action="{{ url('/user/create') }}" method="POST">
                  @csrf
                  <div class="row">
                     <div class="col-xl-6">
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Name</label>
                           <div class="col-lg-9">
                              <input type="text" name="name" value="{{ old('name') }}" class="form-control">    
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">E-Mail</label>
                           <div class="col-lg-9">
                              <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Password</label>
                           <div class="col-lg-9">
                              <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Repeat Password</label>
                           <div class="col-lg-9">
                              <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Gender</label>
                           <div class="col-lg-9">
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male">
                                 <label class="form-check-label" for="gender_male">
                                 Male
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female">
                                 <label class="form-check-label" for="gender_female">
                                 Female
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6">
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">NIP</label>
                           <div class="col-lg-9">
                              <input type="text" name="nip" value="{{ old('nip') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Place Of Birth</label>
                           <div class="col-lg-9">
                              <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Date Of Birth</label>
                           <div class="col-lg-9">
                              <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Status</label>
                           <div class="col-lg-9">
                              <select class="select" name="status">
                                 <option>Select Status</option>
                                 <option value="PNS">PNS</option>
                                 <option value="CPNS">CPNS</option>
                                 <option value="PPPK">PPPK</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">TMT CPNS/PPPK</label>
                           <div class="col-lg-9">
                              <input type="date" name="tmt_cpns" value="{{ old('tmt_cpns') }}" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('javascript')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
{{-- <script>
   var map = L.map('canvas_map').setView([-3.9925268686144904, 122.50657081604005], 13);
   
   var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
       maxZoom: 19,
       attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
   }).addTo(map);
   
   var marker = L.marker([-3.9925268686144904, 122.50657081604005], {
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
</script> --}}
@endpush
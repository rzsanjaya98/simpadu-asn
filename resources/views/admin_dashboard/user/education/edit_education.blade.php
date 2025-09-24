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
               <h5 class="card-title">Education</h5>
               <form action="{{ url('/employeeeducation/'.$edit->id.'/update') }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="row">
                     <div class="col-xl-6">
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Education Level</label>
                           <div class="col-lg-9">
                              <select class="select" name="education_level">
                                 <option>Select Education Level</option>
                                 <option value="SMA/SMK" {{ old('education_level', $edit->education_level ?? '') === 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                 <option value="Diploma I" {{ old('education_level', $edit->education_level ?? '') === 'Diploma I' ? 'selected' : '' }}>Diploma I</option>
                                 <option value="Diploma II" {{ old('education_level', $edit->education_level ?? '') === 'Diploma II' ? 'selected' : '' }}>Diploma II</option>
                                 <option value="Diploma III" {{ old('education_level', $edit->education_level ?? '') === 'Diploma III' ? 'selected' : '' }}>Diploma III</option>
                                 <option value="Diploma IV" {{ old('education_level', $edit->education_level ?? '') === 'Diploma IV' ? 'selected' : '' }}>Diploma IV</option>
                                 <option value="Sarjana (S1)" {{ old('education_level', $edit->education_level ?? '') === 'Sarjana (S1)' ? 'selected' : '' }}>Sarjana (S1)</option>
                                 <option value="Magister (S2)" {{ old('education_level', $edit->education_level ?? '') === 'Magister (S2)' ? 'selected' : '' }}>Magister (S2)</option>
                                 <option value="Doktor (S3)" {{ old('education_level', $edit->education_level ?? '') === 'Doktor (S3)' ? 'selected' : '' }}>Doktor (S3)</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Major</label>
                           <div class="col-lg-9">
                              <input type="text" name="major" value="{{ $edit->major }}" class="form-control">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-lg-3 col-form-label">Graduate</label>
                           <div class="col-lg-9">
                              <input type="date" name="graduate" value="{{ $edit->graduate }}" class="form-control">
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
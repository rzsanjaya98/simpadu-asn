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
      <div class="col-md-6">
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
               <h5 class="card-title">Leave Requests</h5>
               <form action="{{ url('/leave_request/'.$edit->id.'/update') }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="row">
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Jenis Cuti</label>
                        <div class="col-lg-9">
                           <select class="select" name="type_leave_id">
                              <option>Pilih Cuti</option>
                              @foreach ($type_leaves as $type_leave)
                                  <option value="{{ $type_leave->id }}" @selected(old('type_leave_id', $edit->type_leave_id) == $type_leave->id)>{{ $type_leave->type_leave }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Alasan Cuti</label>
                        <div class="col-lg-9">
                           <textarea class="form-control" name="reason">{{ $edit->reason }}</textarea>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-lg-9">
                           <input type="date" name="start_date" value="{{ $edit->start_date }}" class="form-control">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Tanggal Berakhir</label>
                        <div class="col-lg-9">
                           <input type="date" name="end_date" value="{{ $edit->end_date }}" class="form-control">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Alamat Selama Menjalankan Cuti</label>
                        <div class="col-lg-9">
                           <textarea class="form-control" name="address">{{ $edit->address }}</textarea>
                        </div>
                     </div>
                     <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
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

@endpush
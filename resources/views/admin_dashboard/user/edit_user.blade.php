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
                  <form action="{{ url('/user/'.$edit->id.'/update') }}" method="POST">
                     @csrf
                     @method('PATCH')
                     <div class="row">
                        <div class="col-xl-6">
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Name</label>
                              <div class="col-lg-9">
                                 <input type="text" name="name" value="{{ $edit->name }}" class="form-control">    
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">E-Mail</label>
                              <div class="col-lg-9">
                                 <input type="email" name="email" value="{{ $edit->email }}" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">New Password</label>
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
                                    <input class="form-check-input" type="radio" name="gender" value="Male" {{ old('gender', $edit->employee->gender ?? '') === 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_male">
                                    Male
                                    </label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" {{ old('gender', $edit->employee->gender ?? '') === 'Female' ? 'checked' : '' }}>
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
                                 <input type="text" name="nip" value="{{ $edit->employee->nip }}" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Place Of Birth</label>
                              <div class="col-lg-9">
                                 <input type="text" name="place_of_birth" value="{{ $edit->employee->place_of_birth }}" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Date Of Birth</label>
                              <div class="col-lg-9">
                                 <input type="date" name="date_of_birth" class="form-control" value="{{ $edit->employee->date_of_birth }}">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Status</label>
                              <div class="col-lg-9">
                                 <select class="select" name="status">
                                    <option>Select Status</option>
                                    <option value="PNS" {{ old('status', $edit->employee->status ?? '') === 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="CPNS" {{ old('status', $edit->employee->status ?? '') === 'CPNS' ? 'selected' : '' }}>CPNS</option>
                                    <option value="PPPK" {{ old('status', $edit->employee->status ?? '') === 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">TMT CPNS/PPPK</label>
                              <div class="col-lg-9">
                                 <input type="date" name="tmt_cpns" value="{{ $edit->employee->tmt_cpns }}" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-lg-3 col-form-label">No. Karpeg</label>
                              <div class="col-lg-9">
                                 <input type="text" name="no_karpeg" value="{{ $edit->employee->no_karpeg }}" class="form-control">
                              </div>
                           </div>
                        </div>
                        <h5 class="card-title">Rank and Position Information</h5>
                        <div class="row">
                           <div class="col-xl-6">
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">Rank</label>
                                 <div class="col-lg-9">
                                    <select class="form-control js-example-basic-single select2" name="rank_id">
                                       <option>Select Rank</option>
                                       @foreach ($ranks as $rank)                                    
                                          <option value="{{ $rank->id }}" {{ old('rank_id', $edit->employee->rank_id ?? '') === $rank->id ? 'selected' : '' }}>{{ $rank->rank_name.' Gol. '.$rank->rank_group.'/'.$rank->rank_room}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">TMT Rank</label>
                                 <div class="col-lg-9">
                                    <input type="date" name="tmt_rank" value="{{ $edit->employee->tmt_rank }}" class="form-control">
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-6">
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">Position</label>
                                 <div class="col-lg-9">
                                    <select class="form-control form-small nested" name="position_id">
                                       <option>Select Position</option>
                                       @foreach ($positions as $position)                                    
                                          <option value="{{ $position->id }}" {{ old('position_id', $edit->employee->position_id ?? '') === $position->id ? 'selected' : '' }}>{{ $position->position_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">TMT Position</label>
                                 <div class="col-lg-9">
                                    <input type="date" name="tmt_position" value="{{ $edit->employee->tmt_position }}" class="form-control">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h5 class="card-title">Division Information</h5>
                        <div class="row">
                           <div class="col-xl-6">
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">Division</label>
                                 <div class="col-lg-9">
                                    <select class="form-control form-small nested" name="division_id">
                                       <option>Select Division</option>
                                       <optgroup label="Bidang">
                                          @foreach ($divisions as $division)
                                             @if ($division->level == 2)
                                                <option value="{{ $division->id }}" {{ old('division_id', $edit->employee->division_id ?? '') === $division->id ? 'selected' : '' }}>{{ $division->division_name}}</option>
                                             @endif
                                          @endforeach
                                       </optgroup>
                                       <optgroup label="Sub Bagian">
                                          @foreach ($divisions as $division)
                                             @if ($division->level == 3)
                                                <option value="{{ $division->id }}" {{ old('division_id', $edit->employee->division_id ?? '') === $division->id ? 'selected' : '' }}>{{ $division->division_name}}</option>
                                             @endif
                                          @endforeach
                                       </optgroup>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-6">
                              <div class="form-group row">
                                 <label class="col-lg-3 col-form-label">Atasan Langsung</label>
                                 <div class="col-lg-9">
                                    <select class="form-control form-small nested" name="parent_id">
                                       <option>- Pilih Atasan -</option>
                                       @foreach ($userlists as $userlist)                                    
                                          <option value="{{ $userlist->id }}" {{ old('parent_id', $edit->employee->parent_id ?? '') === $userlist->id ? 'selected' : '' }}>{{ $userlist->name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h5 class="card-title">Working Time Information</h5>
                        <div class="row">
                           <div class="col-xl-3">
                              <div class="form-group row">
                                 <div class="col-lg-9">
                                    <input type="text" name="working_time_year" value="{{ $edit->employee->working_time_year }}" class="form-control">
                                 </div>
                                 <label class="col-lg-3 col-form-label">Year</label>
                              </div>
                           </div>
                           <div class="col-xl-3">
                              <div class="form-group row">
                                 <div class="col-lg-9">
                                    <input type="text" name="working_time_month" value="{{ $edit->employee->working_time_month }}" class="form-control">
                                 </div>
                                 <label class="col-lg-3 col-form-label">Month</label>
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

      {{-- <div class="row">
         <div class="col-md-6">
            <div class="card">
               <div class="card-header">
                  <h5 class="card-title">Small Select2</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <p>Use data('select2') function to get container of select2.</p>
                        <select class="form-control form-small select">
                           <option selected="selected">orange</option>
                           <option>white</option>
                           <option>purple</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
   </div>
</div>
@endsection
@push('javascript')


@endpush
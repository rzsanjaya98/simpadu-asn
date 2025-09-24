@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('css')
@section('content')
<div class="page-wrapper">
   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>{{ $menu_name }} Details</h4>
            <h6>Full details of a {{ $menu_name }}</h6>
         </div>
         <div class="page-btn">
            <a href="{{ url('/user/'.$detail->id.'/edit') }}" class="btn btn-added">Update
               User / Employee</a>
         </div>
      </div>
      <div class="row">
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
         <div class="col-lg-8 col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-top">
                     <div class="search-set">
                        <h5 class="card-title">Personal Information</h5>
                     </div>
                     {{-- <div class="wordset">
                           <ul>
                              <li>
                                    <a href="{{ url('/user/'.$detail->id.'/edit') }}">
                                    <button type="button" class="btn btn-block btn-outline-primary active">
                                       Update</button>
                                    </a>
                              </li>
                           </ul>
                     </div> --}}
                  </div>
                  <div class="productdetails">
                     <ul class="product-bar">
                        <li>
                           <h4>Full Name</h4>
                           <h6>{{ $detail->name }}</h6>
                        </li>
                        <li>
                           <h4>E-Mail</h4>
                           <h6>{{ $detail->email }}</h6>
                        </li>
                        <li>
                           <h4>Place and Date of Birth</h4>
                           <h6>{{ $detail->employee->place_of_birth.', '.date('d F Y', strtotime($detail->employee->date_of_birth)) }}</h6>
                        </li>
                        <li>
                           <h4>Gender</h4>
                           <h6>{{ $detail->employee->gender }}</h6>
                        </li>
                        <li>
                           <h4>Status</h4>
                           <h6>{{ $detail->employee->status }}</h6>
                        </li>
                        <li>
                           <h4>NIP</h4>
                           <h6>{{ $detail->employee->nip }}</h6>
                        </li>
                        <li>
                           <h4>TMT CPNS</h4>
                           <h6>{{ $detail->employee->tmt_cpns }}</h6>
                        </li>
                        <li>
                           <h4>No. Karpeg</h4>
                           <h6>{{ $detail->employee->no_karpeg }}</h6>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-top">
                     <div class="search-set">
                        <h5 class="card-title">Rank & Position Information</h5>
                     </div>
                  </div>
                  <div class="productdetails">
                     <ul class="product-bar">
                        <li>
                           <h4>Rank</h4>
                           <h6>{{ $detail->employee->rank ? $detail->employee->rank->rank_name.' Gol. '.$detail->employee->rank->rank_group.'/'.$detail->employee->rank->rank_room : '-' }}</h6>
                        </li>
                        <li>
                           <h4>TMT Rank</h4>
                           <h6>{{ $detail->employee->tmt_rank }}</h6>
                        </li>
                        <li>
                           <h4>Position</h4>
                           <h6>{{ $detail->employee->position ? $detail->employee->position->position_name : '-' }}</h6>
                        </li>
                        <li>
                           <h4>TMT Position</h4>
                           <h6>{{ $detail->employee->tmt_position }}</h6>
                        </li>
                        <li>
                           <h4>Working Time</h4>
                           @if ($detail->employee->working_time_year || $detail->employee->working_time_month != null)
                              <h6>{{ $detail->employee->working_time_year.' Years '.$detail->employee->working_time_month.' Month' }}</h6>
                           @endif
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-top">
                     <div class="search-set">
                        <h5 class="card-title">Education</h5>
                     </div>
                     <div class="wordset">
                           <ul>
                              <li>
                                    <a href="{{ url('/employeeeducation/'.$detail->id.'/add') }}">
                                    <button type="button" class="btn btn-block btn-outline-primary active">
                                       Add Education</button>
                                    </a>
                              </li>
                           </ul>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table mb-0">
                        <thead>
                           <tr>
                              <th>Education Level</th>
                              <th>Major</th>
                              <th>Graduate</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if (count($detail->education) != 0)
                              @foreach ($detail->education as $education)
                                 <tr>
                                    <td>{{ $education->education_level }}</td>
                                    <td>{{ $education->major }}</td>
                                    <td>{{ $education->graduate }}</td>
                                    <td>
                                       <a class="me-3" href="{{ url('/employeeeducation/'.$education->id.'/edit') }}">
                                          <img src="{{ asset('dashboard_admin/assets/img/icons/edit.svg')}}" alt="img">
                                       </a>
                                       <a class="me-3" href="{{ url('/employeeeducation/'.$education->id.'/delete') }}" onclick="return confirm('Are you sure want to delete this employee education?')">
                                          <img src="{{ asset('dashboard_admin/assets/img/icons/delete.svg')}}" alt="img">
                                       </a>
                                    </td>
                                 </tr>
                              @endforeach
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-top">
                     <div class="search-set">
                        <h5 class="card-title">Leaves</h5>
                     </div>
                     <div class="wordset">
                           <ul>
                              <li>
                                 @can('create', App\Models\LeaveBalance::class)
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add{{ $detail->id }}">
                                    <button type="button" class="btn btn-block btn-outline-primary active">
                                       Add Amount of Leave</button>
                                    </a>
                                 @endcan
                              </li>
                           </ul>
                           {{-- Modal Add --}}
                           <div class="modal fade" id="add{{ $detail->id }}" tabindex="-1" aria-labelledby="add{{ $detail->id }}" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Add Amount of Leaves</h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="{{ url('/leavebalance/'.$detail->id.'/create') }}" method="POST">
                                             @csrf
                                             {{-- @method('PATCH') --}}
                                             <div class="row">
                                                   <div class="col-sm-6 col-12">
                                                      <input type="hidden" name="user_id" value="{{ $detail->id }}">
                                                      <div class="form-group">
                                                         <label>Year</label>
                                                         <select class="form-control form-small nested" name="year" id="year">
                                                            <option>- Pilih Tahun -</option>
                                                            @for ($i = 2020; $i <= 2025; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-sm-6 col-12">
                                                      <div class="form-group">
                                                         <label>Jumlah Cuti</label>
                                                         <input type="text" name="remaining_leave" value="{{ old('remaining_leave') }}">
                                                      </div>
                                                   </div>
                                             </div>
                                             <div class="col-lg-12 text-center">
                                                   <button class="btn btn-submit me-2">Submit</button>
                                                   <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                                             </div>
                                          </form>
                                       </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table mb-0">
                        <thead>
                           <tr>
                              <th>Year</th>
                              <th>Leave Remaining</th>
                              @if (Auth::user()->role_id === 1)
                                 <th>Action</th>
                              @endif
                           </tr>
                        </thead>
                        <tbody>
                           @if (count($detail->leave_balance) != 0)
                              @foreach ($detail->leave_balance as $leave_balance)
                                 <tr>
                                    <td>{{ $leave_balance->year }}</td>
                                    <td>{{ $leave_balance->remaining_leave." Hari" }}</td>
                                    @if (Auth::user()->role_id === 1)
                                       <td>
                                          <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#update{{ $leave_balance->id }}" class="me-3">
                                             <img src="{{ asset('dashboard_admin/assets/img/icons/edit.svg')}}" alt="img">
                                          </a>
                                          <a class="me-3" href="{{ url('/leavebalance/'.$leave_balance->id.'/delete') }}" onclick="return confirm('Are you sure want to delete this?')">
                                             <img src="{{ asset('dashboard_admin/assets/img/icons/delete.svg')}}" alt="img">
                                          </a>
                                       </td>
                                    @endif
                                    {{-- Modal Update --}}
                                    <div class="modal fade" id="update{{ $leave_balance->id }}" tabindex="-1" aria-labelledby="update{{ $leave_balance->id }}" aria-hidden="true">
                                       <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title">Update Amount of Leaves</h5>
                                                   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                                   </button>
                                                </div>
                                                <div class="modal-body">
                                                   <form action="{{ url('/leavebalance/'.$leave_balance->id.'/update') }}" method="POST">
                                                      @csrf
                                                      @method('PATCH')
                                                      <div class="row">
                                                            <div class="col-sm-6 col-12">
                                                               <input type="hidden" name="user_id" value="{{ $leave_balance->user_id }}">
                                                               <input type="hidden" name="year" value="{{ $leave_balance->year }}">
                                                               <div class="form-group">
                                                                  <label>Year</label>
                                                                  <input class="form-control" type="year" name="year1" value="{{ $leave_balance->year }}" disabled>
                                                               </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                               <div class="form-group">
                                                                  <label>Jumlah Cuti</label>
                                                                  <input type="text" name="remaining_leave" value="{{ $leave_balance->remaining_leave }}">
                                                               </div>
                                                            </div>
                                                      </div>
                                                      <div class="col-lg-12 text-center">
                                                            <button class="btn btn-submit me-2">Submit</button>
                                                            <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                                                      </div>
                                                   </form>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                 </tr>
                              @endforeach
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('content')
    {{-- @yield('sidebar') --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List {{ $menu_name }}</h4>
                    <h6>Persetujuan {{ $menu_name }}</h6>
                </div>
                {{-- <div class="page-btn">
                    <a href="{{ url('/leave_request/add') }}" class="btn btn-added">
                    <img src="{{ asset('dashboard_admin/assets/img/icons/plus.svg') }}" alt="img">Add {{ $menu_name }}
                    </a>
                </div> --}}
            </div>
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
                <div class="card-body">
                    <div class="card" id="filter_inputs">
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP - Nama</th>
                                    <th>Jenis Cuti</th>
                                    <th>Jumlah Hari</th>
                                    <th>Mulai - Akhir</th>
                                    <th>Alasan Cuti</th>
                                    <th>Persetujuan Pejabat yang Berwenang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leave_approval as $leave_approvals)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $leave_approvals->leave_request->users->employee->nip }}<br>{{ $leave_approvals->leave_request->users->name }}</td>
                                    <td>{{ $leave_approvals->leave_request->type_leave->type_leave }}</td>
                                    <td>{{ $leave_approvals->leave_request->amount_days.' Hari' }}</td>
                                    <td>{{ date('d M Y', strtotime($leave_approvals->leave_request->start_date)) }}<br>-<br>{{ date('d M Y', strtotime($leave_approvals->leave_request->end_date)) }}</td>
                                    <td>{{ $leave_approvals->leave_request->reason }}</td>
                                    <td><span class="badges {{ $leave_approvals->leader_status === 'approved' 
                                                                                ? 'bg-lightgreen' 
                                                                                : ($leave_approvals->leader_status === 'pending' 
                                                                                    ? 'bg-lightyellow' 
                                                                                    : 'bg-lightred') }}"
                                                                                    >{{ $leave_approvals->leader_status }}</span>
                                                                                </td>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" {{ in_array($leave_approvals->supervisor_status, ['pending', 'rejected']) ? 'disabled' : '' }}>
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#rejected{{ $leave_approvals->leave_request_id }}"><img src="{{ asset('dashboard_admin/assets/img/icons/thumbs-down.svg')}}" class="me-2" alt="img">Rejected</a>
                                            </li>
                                            <li>
                                                <form id="approve-form-{{ $leave_approvals->leave_request_id }}" action="{{ url('/leave_approval/'.$leave_approvals->leave_request_id.'/leave_approved_leader') }}" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('PATCH')                                                
                                                </form>
                                                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('approve-form-{{ $leave_approvals->leave_request_id }}').submit();"><img src="{{ asset('dashboard_admin/assets/img/icons/thumbs-up.svg')}}" class="me-2" alt="img">Approved</a>        
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal Rejected --}}
            <div class="modal fade" id="rejected{{ $leave_approvals->leave_request_id }}" tabindex="-1" aria-labelledby="rejected{{ $leave_approvals->leave_request_id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rejected Leaves</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/leave_approval/'.$leave_approvals->leave_request_id.'/leave_rejected_leader') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea name="supervisor_note" id="" cols="20" rows="10"></textarea>
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
@endsection
{{-- @extends('admin_dashboard.layout.footer') --}}
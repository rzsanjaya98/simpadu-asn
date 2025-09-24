@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('content')
    {{-- @yield('sidebar') --}}
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>List {{ $menu_name }}</h4>
                    <h6>Manage your {{ $menu_name }}</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ url('/leave_request/add') }}" class="btn btn-added">
                    <img src="{{ asset('dashboard_admin/assets/img/icons/plus.svg') }}" alt="img">Add {{ $menu_name }}
                    </a>
                </div>
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
                                @if (Auth::user()->role_id === 1)
                                    <th>NIP - Nama</th>
                                @endif
                                <th>Jenis Cuti</th>
                                <th>Jumlah Hari</th>
                                <th>Mulai - Akhir</th>
                                <th>Alasan Cuti</th>
                                <th>Persetujuan Atasan</th>
                                <th>Persetujuan Pejabat yang Berwenang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave_request as $leave_requests)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                @if (Auth::user()->role_id === 1)
                                    <td>{{ $leave_requests->users->employee->nip }}<br>{{ $leave_requests->users->name }}</td>
                                @endif
                                <td class="text-bolds">{{ $leave_requests->type_leave->type_leave }}</td>
                                <td>{{ $leave_requests->amount_days.' Hari' }}</td>
                                <td>{{ date('d M Y', strtotime($leave_requests->start_date)) }}<br>-<br>{{ date('d M Y', strtotime($leave_requests->end_date)) }}</td>
                                <td>{{ $leave_requests->reason }}</td>
                                <td><span class="badges {{ $leave_requests->leave_approval->supervisor_status === 'approved' 
                                                                            ? 'bg-lightgreen' 
                                                                            : ($leave_requests->leave_approval->supervisor_status === 'pending' 
                                                                                ? 'bg-lightyellow' 
                                                                                : 'bg-lightred') }}"
                                                                                >{{ $leave_requests->leave_approval->supervisor_status }}</span>
                                                                            <br>
                                                                            {{ $leave_requests->leave_approval->supervisor_note ? 'Catatan : '.$leave_requests->leave_approval->supervisor_note : '' }}
                                                                            </td>
                                <td><span class="badges {{ $leave_requests->leave_approval->leader_status === 'approved' 
                                                                            ? 'bg-lightgreen' 
                                                                            : ($leave_requests->leave_approval->leader_status === 'pending' 
                                                                                ? 'bg-lightyellow' 
                                                                                : 'bg-lightred') }}">{{ $leave_requests->leave_approval->leader_status }}</span>
                                                                            <br>
                                                                            {{ $leave_requests->leave_approval->leader_note ? 'Catatan : '.$leave_requests->leave_approval->leader_note : '' }}
                                                                            </td>
                                <td>
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" {{ $leave_requests->status === 'pending' ? 'disabled' : '' }}>
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if ($leave_requests->status == 'rejected')
                                            <li>
                                                <a href="{{ url('/leave_request/'.$leave_requests->id.'/edit') }}" class="dropdown-item"><img src="{{ asset('dashboard_admin/assets/img/icons/edit.svg')}}" class="me-2" alt="img">Edit</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/leave_request/'.$leave_requests->id.'/delete') }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete this Pengajuan Cuti ?')" ><img src="{{ asset('dashboard_admin/assets/img/icons/delete1.svg')}}" class="me-2" alt="img">Delete</a>        
                                            </li>                                 
                                        @else
                                            <li>
                                                <a href="{{ url('/leave_request/'.$leave_requests->id.'/save') }}" class="dropdown-item" ><img src="{{ asset('dashboard_admin/assets/img/icons/book.svg')}}" class="me-2" alt="img">Surat Cuti</a>
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
{{-- @extends('admin_dashboard.layout.footer') --}}
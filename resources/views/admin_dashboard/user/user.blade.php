@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>{{ $menu_name }} List</h4>
                    <h6>Manage your {{ $menu_name }}</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ url('/user/add') }}" class="btn btn-added"><img
                            src="{{ asset('dashboard_admin/assets/img/icons/plus.svg')}}" alt="img">Add
                        User / Employee</a>
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
                    {{-- <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('dashboard_admin/assets/img/icons/filter.svg')}}" alt="img">
                                    <span><img src="{{ asset('dashboard_admin/assets/img/icons/closes.svg')}}"
                                            alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('dashboard_admin/assets/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                            src="{{ asset('dashboard_admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                            src="{{ asset('dashboard_admin/assets/img/icons/excel.svg')}}" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                            src="{{ asset('dashboard_admin/assets/img/icons/printer.svg')}}" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                    {{-- <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter User Name">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Disable</option>
                                            <option>Enable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img
                                                src="{{ asset('dashboard_admin/assets/img/icons/search-whites.svg')}}"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="table-responsive">
                        <table class="table datanew text-center">
                            <thead>
                                <tr>
                                    {{-- <th>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th> --}}
                                    <th>No</th>
                                    <th>NIP/Name</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>E-Mail/Roles</th>
                                    <th>Ranks</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        {{-- <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td> --}}
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->employee->nip }}<br>{{ $user->name }}</td>
                                        <td class="__cf_email__">{{ $user->email }}<br><span class="badges bg-lightyellow">{{ $user->role ? $user->role->role_name : '-' }}</span></td>
                                        <td>
                                            {{ $user->employee->rank ? $user->employee->rank->rank_name.' Gol. '.$user->employee->rank->rank_group.'/'.$user->employee->rank->rank_room : '-' }}
                                        </td>
                                        <td>
                                            {{ $user->employee->position ? $user->employee->position->position_name : '-' }}
                                        </td>
                                        <td>
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ url('/user/'.$user->id.'/detail') }}" class="dropdown-item"><img src="{{ asset('dashboard_admin/assets/img/icons/eye1.svg')}}" class="me-2" alt="img">Detail</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/user/'.$user->id.'/delete') }}" class="dropdown-item" onclick="return confirm('Are you sure want to delete this User/Employee ?')"><img src="{{ asset('dashboard_admin/assets/img/icons/delete-2.svg')}}" class="me-2" alt="img">Delete</a>        
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#roles{{ $user->id }}"><img src="{{ asset('dashboard_admin/assets/img/icons/edit-5.svg')}}" class="me-2" alt="img">Roles</a>
                                                </li>
                                            </ul>
                                        </td>

                                        {{-- Modal Roles --}}
                                        <div class="modal fade" id="roles{{ $user->id }}" tabindex="-1" aria-labelledby="roles{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Roles</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/user/'.$user->id.'/update_role') }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div class="form-group">
                                                                        <label>Role</label>
                                                                        <select class="select"  name="role_id">
                                                                            @foreach ($roles as $role)
                                                                                <option value="{{ $role->id }}" @selected($user->role_id === $role->id)>{{ $role->role_name }}</option>
                                                                            @endforeach
                                                                        </select>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
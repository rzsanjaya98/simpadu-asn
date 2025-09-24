@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>{{ $menu_name }}</h4>
                    <h6>Manage your {{ $menu_name }}</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ '/store/add' }}" class="btn btn-added"><img
                            src="{{ asset('dashboard_admin/assets/img/icons/plus.svg')}}" alt="img">Add
                        {{ $menu_name }}</a>
                </div>
            </div>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>      
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
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
                    </div>

                    <div class="card" id="filter_inputs">
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
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($storelist as $store)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>{{ $store->store_name }}</td>
                                        <td>123-456-888</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="62011711160d0f071022071a030f120e074c010d0f">[email&#160;protected]</a>
                                        </td>
                                        <td>Manager </td>
                                        <td>{{ date("d/m/Y", strtotime($store->created_at)) }}</td>
                                        {{-- <td><span class="bg-lightred badges">Restricted</span></td> --}}
                                        <td>
                                            <a class="me-3" href="{{ url('/store/'.$store->id.'/detail') }}">
                                                <img src="{{ asset('dashboard_admin/assets/img/icons/eye.svg')}}" alt="img">
                                            </a>
                                            <a class="me-3" href="{{ url('/store/'.$store->id.'/edit') }}">
                                                <img src="{{ asset('dashboard_admin/assets/img/icons/edit.svg')}}" alt="img">
                                            </a>
                                            <a class="me-3" href="{{ url('/store/'.$store->id.'/delete') }}">
                                                <img src="{{ asset('dashboard_admin/assets/img/icons/delete.svg')}}" alt="img">
                                            </a>
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
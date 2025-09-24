@extends('admin_dashboard.layout.main')
@extends('admin_dashboard.layout.sidebar')
@section('content')
    {{-- @yield('sidebar') --}}
    <div class="page-wrapper">
        <div class="content">
            {{-- <div class="page-header">
                <div class="page-title">
                    <h4>Selamat Datang <h3 class="section-title">{{ Auth::user()->name }}</h3></h4>
                </div>
            </div> --}}
            <div class="comp-sec-wrapper">
                <div class="section-header">
                    <h3 class="section-title">Selamat Datang {{ Auth::user()->name }}</h3>
                    <div class="line"></div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('dashboard_admin/assets/img/icons/dash1.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>$<span class="counters" data-count="307144.00">$307,144.00</span></h5>
                            <h6>Total Purchase Due</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('dashboard_admin/assets/img/icons/dash2.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>$<span class="counters" data-count="4385.00">$4,385.00</span></h5>
                            <h6>Total Sales Due</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('dashboard_admin/assets/img/icons/dash3.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>$<span class="counters" data-count="385656.50">385,656.50</span></h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset('dashboard_admin/assets/img/icons/dash4.svg')}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>$<span class="counters" data-count="40000.00">400.00</span></h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Customers</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>100</h4>
                            <h5>Suppliers</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>{{ Auth::user()->leave_request->count() }}</h4>
                            <h5>Jumlah Pengajuan Cuti</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>{{ Auth::user()->leave_balance->sum('remaining_leave') }} Hari</h4>
                            <h5>Sisa Cuti</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="cloud"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>{{ $employee-1 }} Orang</h4>
                            <h5>Jumlah Pegawai</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-12 d-flex">
                     <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                           <h4 class="card-title mb-0">Pejabat Struktural</h4>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive dataview">
                              <table class="table datatable text-center ">
                                 <thead>
                                    <tr>
                                       <th>Jabatan</th>
                                       <th>Nama</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <td>{{ $position->position_name }}</td>
                                            <td>{{ $position->employee[0]->nip }}<br>{{ $position->employee[0]->users->name }}</td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-12 d-flex">
                     <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                           <h4 class="card-title mb-0">Jumlah Pegawai Berdasarkan Golongan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart_ranks"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        var ranks = @json($ranks);

        // Extract just the counts
        var data_ranks = ranks.map(function(item) {
            return item.employee_count;
        });

        // Optional: labels for each slice
        var labels_ranks = ranks.map(function(item) {
            return item.rank_group;
        });

        var options = {
          series: data_ranks,
          chart: {
          type: 'polarArea',
        },
        labels: labels_ranks,
        stroke: {
          colors: ['#fff']
        },
        fill: {
          opacity: 0.8
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_ranks"), options);
        chart.render();
    </script>
@endpush
{{-- @extends('admin_dashboard.layout.footer') --}}
@extends('admin.main-admin')
@section('page-wrapper')
 <!-- Page header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Welcome, {{ Str::title(auth()->user()->name) }}.
          </div>
          <h2 class="page-title">
            Dashboard . . .
          </h2>
        </div>
        <!-- Page title actions -->
        
      </div>
    </div>
  </div>
<div class="page-body" >
          <div class="container-xl">

            <div class="col-12">
              <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                  <div class="card card-sm">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                          </span>
                        </div>
                        <div class="col">
                          <div class="font-weight-medium">
                            Rp. {{ number_format($total_pembayaran) }}
                          </div>
                          <div class="text-muted">
                            Akumulasi Pembayaran
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card card-sm">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                          </span>
                        </div>
                        <div class="col">
                          <div class="font-weight-medium">
                            {{ DB::table('transaksi')->count() }}
                          </div>
                          <div class="text-muted">
                             Melakukan Transaksi
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card card-sm">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-bag" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /></svg>                          </span>
                        </div>
                        <div class="col">
                          <div class="font-weight-medium">
                            {{  
                            $total_stok
                            }}
                          </div>
                          <div class="text-muted">
                            Barang Tersedia
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                  <div class="card card-sm">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-auto">
                          <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /><path d="M15 19l2 2l4 -4" /></svg>                          </span>
                        </div>
                        <div class="col">
                          <div class="font-weight-medium">
                            {{ DB::table('users')->count() }}
                          </div>
                          <div class="text-muted">
                            User Aktif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="subheader">Keuntungan Bulan Ini</div>
                        <div class="ms-auto lh-1">
                          {{-- <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tahun Ini</a>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item active" href="#">Tahun Kemarin</a>
                              <a class="dropdown-item" href="#">2 Tahun Kemarin</a>
                              <a class="dropdown-item" href="#">3 Tahun Kemarin</a>
                            </div>
                          </div> --}}
                        </div>
                      </div>
                      <div class="d-flex align-items-baseline">
                        @php
                            $labasum = 0;
                        @endphp
                        @foreach ($keuntungan as $item)
                            @php
                                $labasum += $item->total_keuntungan;
                            @endphp
                        @endforeach
                        <div class="h1 mb-0 me-2">Rp. {{ $labasum }}</div>
                        <div class="me-auto">
                          <span class="text-green d-inline-flex align-items-center lh-1">
                             <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l6 -6l4 4l8 -8" /><path d="M14 7l7 0l0 7" /></svg>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div id="chart-revenue-bg" class="chart-sm"></div>
                  </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <div id="table-default" class="table-responsive">
                   
                        <table class="display table card-table table-vcenter text-nowrap datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>ID Barang</th>
                                <th>Barang</th>
                                <th>Sisa</th>
                                <th data-searchable="false">Action</th>
                            </tr>
                        </thead>
                        @php
                        $no = 1;
                        @endphp
                        <tbody class="table-tbody">
                          @foreach (DB::table('databarang')->where('stok', '<', 10)->get() as $item)

                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->id_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td><b>{{ $item->stok }}</b></td>
                                {{-- <td class="pass-td">{{ $d -> password }}</td> --}}
                                <td class="d-flex">
                                  <form action="/pasokbarang/showPasok/{{ $item->id }}"
                                    method="get">
                                    <button class="btn btn-primary mr-2"><i
                                            class="fa fa-edit"></i>Restok</button>
                                </form>                                       
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
            </div>

          </div>
        </div>
        <script>
          // @formatter:off
          document.addEventListener("DOMContentLoaded", function() {
              window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                  chart: {
                      type: "area",
                      fontFamily: 'inherit',
                      height: 40.0,
                      sparkline: {
                          enabled: true
                      },
                      animations: {
                          enabled: false
                      },
                  },
                  dataLabels: {
                      enabled: false,
                  },
                  fill: {
                      opacity: .16,
                      type: 'solid'
                  },
                  stroke: {
                      width: 2,
                      lineCap: "round",
                      curve: "smooth",
                  },
                  series: [{
                      name: "Total Pendapatan",
                      data: [
                          @foreach ($data_cart as $item)
                          {{ $item->total_bayar }},
                          @endforeach
                      ]
                  }],
                  tooltip: {
                      theme: 'dark'
                  },
                  grid: {
                      strokeDashArray: 4,
                  },
                  xaxis: {
                      labels: {
                          padding: 0,
                      },
                      tooltip: {
                          enabled: false
                      },
                      axisBorder: {
                          show: false,
                      },
                      type: 'text',
                  },
                  yaxis: {
                      labels: {
                          padding: 4
                      },
                  },
                  labels: [
                      'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'
                  ],
                  colors: [tabler.getColor("success")],
                  legend: {
                      show: false,
                  },
              })).render();
          });
          // @formatter:on
      </script>

       
@endsection
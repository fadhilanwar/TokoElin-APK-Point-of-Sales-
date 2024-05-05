@extends('admin.main-admin')
@section('page-wrapper')
 <!-- Page header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Barang > List {{ $title }}
          </div>
          <h2 class="page-title">
            {{ $title }}
          </h2>
        </div>
        <!-- Page title actions -->
    
      </div>
    </div>
  </div>
<div class="page-body">
    <div class="container-xl">

        <div class="row d-flex">
            
            <div class="col md-6">
                <div class="card p-4">
                <h3>Log Transaksi</h3>
                <div id="table-default" class="table-responsive">
                   
                    <table id="table_" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kejadian</th>
                                <th>Tanggal</th>                                        
                            </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($log_transaksi as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->aktivitas }}</td>
                            <td>{{ $d->waktu }}</td>  
                            

                        </tr>
                        
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>

        <div class="col md-6">
                <div class="card p-4">
                <h3>Bon Dicatat</h3>

                <div id="table-default" class="table-responsive">
                   
                    <table id="table_" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kejadian</th>
                                <th>Tanggal</th>                                        
                            </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($log_bon as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->aktivitas }}</td>
                            <td>{{ $d->waktu }}</td>  
                            

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
              
        
@endsection
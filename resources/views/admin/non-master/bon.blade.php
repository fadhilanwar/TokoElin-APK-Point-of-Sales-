@extends('admin.main-admin')
@section('page-wrapper')
 <!-- Page header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Histori > Data Bon
          </div>
          <h2 class="page-title">
            Bon
          </h2>
        </div>
        <!-- Page title actions -->
        
      </div>
    </div>
  </div>
<div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-body">
                <div class="border-bottom py-3 mb-3">
                    
                  <div class="row bg-">
                    <h3>
                        Cetak Per Tanggal
                    </h3>
                    <div class="col-md-4">
                        <form action="/bon/cari" method="post">
                            @csrf
                            <label for="">Tanggal Awal</label>
                        <input class="form-control" type="date" name="tgl_awal" required>
                    </div>
                    <div class="col md-4">
                        <label for="">Tanggal Akhir</label>
                        <input class="form-control" type="date" name="tgl_akhir" required>
                        
                    </div>
                    <div class="col md-4">
                        <br>   {{--SPACE or Margin Top --}}
                        <button type="submit" class="btn btn-warning w-100">Cari Data</button>
                        </form>

                    </div>
                </div>
                    <div class="row mt-3">
                       <div class="col md-4">
                        <form action="/cetakAllBon" method="get">
                        @csrf
                         <button class="btn btn-success w-100">Cetak Keseluruhan</button>
                        </div>
                        <div class="col md-4"><select class="form-control" name="status">
                          <option value="">Semua Data</option>
                          <option value="Lunas">Lunas</option>
                          <option value="Belum Lunas">Belum Lunas</option>
                        </select></div>
                      </form>
                       <div class="col md-4">
                       </div>
                      
                    </div>
                    {{-- <div class="col-md-6">
                        <a href="/rekap">
                            <button  class="btn btn-info">Refresh</button>
                        </a>
                    </div> --}}
                   
                  </div>
             
                <div id="table-default" class="table-responsive">
                   
                    <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>ID Bon</th>
                            <th>No. Trans</th>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Sisa Bayar</th>
                            <th>Status</th>
                            <th data-searchable="false">Action</th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($bon as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->id_bon }}</td>
                            <td>{{ $d->no_transaksi }}</td>
                            <td>{{ $d->tgl_transaksi }}</td>
                            <td>{{ $d->nama_pembeli }}</td>
                            <td>{{ $d->sisa_bayar }}</td>
                            <td>
                              @if($d->status_pembayaran == 'Lunas')
                              <span style="border-radius: 10px; background: green; color: white; padding: 5px;">  {{ $d->status_pembayaran }}</span>
                              @else
                              <span style="border-radius: 10px;background: red; color: white; padding: 5px;">  {{ $d->status_pembayaran }}</span>
                            @endif
                            
                            </td>
                            <td class="d-flex">
                              @if($d->status_pembayaran == 'Lunas')

                              @else
                              <button data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}" style="margin-right: 10px"
                                class="btn btn-primary mr-2"><i class="fa fa-edit"></i>Edit</button>                            
                                @endif
                               

                                    {{-- KUMPULAN MODAL --}}
        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Status Pembayaran</h5>
                  </div>
                  <div class="modal-body">
                      <form class="login-input" action="/bayar/{{$d->id}}"
                          method="POST">
                          @csrf
                          {{-- @method('PUT') --}}
                          <div class="form-group">
                              <label for="recipient-name" class="col-form-label">ID Bon :</label>
                              <input value="{{ $d->id_bon }}" type="text"
                                  class="form-control txt" id="recipient-name" name="id_bon" style="background: #eee" readonly>
                                  {{-- HIDDEN FIELD --}}
                                  <input value="{{ auth()->user()->name  }}" type="hidden"
                                  class="form-control txt" id="recipient-name" name="kasir" readonly>
                                  <input value="{{ $d->total_bayar  }}" type="hidden"
                                  class="form-control txt" id="recipient-name" name="total_bayar" readonly>
                                  {{-- HIDDEN FIELD --}}
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-form-label">No Transaksi :</label>
                              <input type="text" class="form-control txt" id="no_transaksi"
                                  name="no_transaksi" value="{{ $d->no_transaksi }}" style="background: #eee" readonly>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-form-label">Nama Pembeli :</label>
                              <input type="text" class="form-control txt" id="nama_pembeli"
                                  name="nama_pembeli" value="{{ $d->nama_pembeli }}">
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-form-label">Sisa Bayar :</label>
                              <input type="number" class="form-control txt" id="sisa_bayar"
                                  name="sisa_bayar" value="{{ $d->sisa_bayar }}" style="background: #eee" readonly>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-form-label">Status Pembayaran :</label>
                              <input type="text" class="form-control txt" id="status_pembayaran"
                                  name="status_pembayaran" value="{{ $d->status_pembayaran }}" style="background: #eee" readonly>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-form-label">Bayar :</label>
                              <input type="number" class="form-control txt" id="bayar" name="bayar">
                          </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                          Cancel
                      </button>
                      <button type="submit" class="btn btn-primary">Change
                          Data</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      {{-- KUMPULAN MODAL --}}


                                    <button data-bs-toggle="modal" data-bs-target="#delete{{ $d->id }}" class="btn btn-danger">
                                      Hapus
                                   </button>
                                   
                            </td>

                        </tr>
                        <div class="modal modal-blur fade" id="delete{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                <h3>Are you sure?</h3>
                                <div class="text-muted">Aksi ini akan menghapus Data BON dengan ID ({{ $d->id_bon }}). Hutang dimiliki oleh : {{ $d->nama_pembeli }}</div>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100 mb-2" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                      <form method="get" action="{{ url('bon/destroy/' . $d->id) }}">
                                        @csrf
                                        {{-- @method('DELETE') --}}
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fa fa-trash"></i>Hapus
                                        </button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <script>
          function filterData(){
            const status = document.getElementById('status').value;
            $url = URL::to('bon/filter');

            $.ajax({
              url: $url,
              type: 'get',
              data: {
                status: status
              },
              success: function(data) {
                document.getElementById('table_id').innerHTML = data;
              }
            });
          }
        </script> --}}
        
      
@endsection
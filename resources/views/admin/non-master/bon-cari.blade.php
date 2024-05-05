@extends('admin.main-admin')
@section('page-wrapper')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Histori > {{ $title }}
                    </div>
                    <h2 class="page-title">
                        {{ $title }} (Filterred)
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
                        <div class="row">
                            <h3>
                                Cetak Per Tanggal
                            </h3>
                            <div class="col md-4">
                                <form action="/bon/cari-cetak" method="post">
                                    @csrf
                                    <label for="">Tanggal Awal</label>
                                <input class="form-control" type="date" name="tgl_awal" required> 
                            </div>
                            <div class="col md-4">
                                <label for="">Tanggal Akhir</label>
                                <input class="form-control" type="date" name="tgl_akhir" required>
                                
                            </div>
                            <div class="col md-4">
                                <br>
                                <a href="/bon/cari-cetak" target="_blank">

                                    <button type="submit"  class="btn btn-success">Cetak Data / Tanggal</button>
                                </a>
                                </form>
                                <a href="/bon">
                                    <button class="btn btn-info">Kembali</button>
                                </a>

                            </div>
                        </div>

                        <div class="row mt-3">
                        <div class="col md-2">
                          
                            {{-- <a href="/cetakPenjualanTgl" target="_blank"> --}}
                            {{-- </a> --}}
                        </form>
                        </div>
                        <div class="col md-2">
                           
                        </div>
                        <div class="col md-2"></div>
                        <div class="col md-2"></div>
                        <div class="col md-2">

                        </div>
                        <div class="col md-2">
                            
                        </div>
                        </div>
                    </div>
                   

                    <div id="table-default" class="table-responsive">

                        <table id="table_supp" class="display table card-table table-vcenter text-nowrap datatable">
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
                                <button data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}" style="margin-right: 10px"
                                    class="btn btn-primary mr-2"><i class="fa fa-edit"></i>Edit</button>

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

    {{-- KUMPULAN MODAL --}}
    {{-- MODAL ADD START --}}
    <div class="modal modal-blur fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Error Notifikasi --}}
                    @error('nama_supplier')
                        @php
                            alert()->error('Gagal Bro !', 'Baca Kembali Aturan Validasi...');
                        @endphp
                    @enderror
                    @error('alamat')
                        @php
                            alert()->error('Gagal Bro !', 'Baca Kembali Aturan Validasi...');
                        @endphp
                    @enderror
                    @error('no_tlp')
                        @php
                            alert()->error('Gagal Bro !', 'Baca Kembali Aturan Validasi...');
                        @endphp
                    @enderror
                    {{-- Error Notifikasi END END --}}

                    <form action="/datasupplier" method="post">
                        @csrf
                        <div class="form-group">
                            {{-- <label for="recipient-name" class="col-form-label">ID User:</label>
                    --}}
                            <input type="hidden" class="form-control txt" id="recipient-name" name="id">
                            <input type="text" class="form-control txt" id="recipient-name" name="id_supplier">

                            <div class="form-group">
                                <label for="nama_supplier" class="col-form-label">Nama Supplier :</label>
                                <input value="{{ old('nama_supplier') }}" type="text"
                                    class="form-control txt @error('nama_supplier') is-invalid @enderror"
                                    id="nama_supplier" name="nama_supplier">
                                @error('nama_supplier')
                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat :</label>

                                <textarea type="text" class="form-control txt @error('alamat') is-invalid @enderror" name="alamat"
                                    rows="5">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_tlp" class="col-form-label">Nomor Telepon :</label>
                                <input value="{{ old('no_tlp') }}" type="number"
                                    class="form-control txt @error('no_tlp') is-invalid @enderror" id="name"
                                    name="no_tlp">
                                @error('no_tlp')
                                    {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">Create Supplier</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL ADD END END --}}
    {{-- MODAL EDIT START --}}

    {{-- Edit --}}
    {{-- MODAL EDIT END END --}}
    {{-- MODAL DELETE --}}
    {{-- MODAL DELETE --}}

    {{-- @endforeach
      {{-- MODAL DELETE END END --}}

    {{-- MODAL DELETE END END --}}

    {{-- KUMPULAN MODAL END END  --}}
    {{-- MODAL EDIT START --}}




@endsection

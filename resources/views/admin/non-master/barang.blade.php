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
            <div class="card">
              <div class="card-body">
                <div class="border-bottom py-3 mb-3">
                    <button data-bs-toggle="modal" data-bs-target="#add" class="btn btn-success w-25">
                       + Add {{ $title }}
                    </button>
                   
                  </div>
                {{-- <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                        </div>
                        entries
                      </div>
                      <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                      </div>
                    </div>
                  </div> --}}
                 
                <div id="table-default" class="table-responsive">
                   
                    <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>                                        
                                <th>Jenis</th>                                        
                                <th style="color: red">Harga Grosir</th>                                        
                                <th style="color: blue">Harga Jual</th>                                        
                                <th style="color: green">Profit</th>                                        
                                <th>Stok</th>                                        
                                <th data-searchable="false">Action</th>
                            </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($data_barang as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->id_barang }}</td>
                            <td>{{ $d->nama_barang }}</td>  
                            <td>{{ $d->nama_jenis }}</td>  
                            <td>Rp. {{ number_format($d->harga_grosir) }} / Pcs</td>  
                            <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>  
                            <td style="color: green">Rp. {{ number_format($d->harga_satuan - $d->harga_grosir) }}</td>  
                            <td>{{ $d->stok }}</td>  
                            <td class="d-flex">
                                <button data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}" style="margin-right: 10px"
                                    class="btn btn-primary mr-2"><i class="fa fa-edit"></i>Edit</button>


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
                                <div class="text-muted">Aksi ini akan menghapus Data ({{ $d->nama_barang }}) dari Data Anda</div>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100 mb-2" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                      <form method="get" action="{{ url('barang/destroy/' . $d->id) }}">
                                        @csrf
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
            <form action="/barang" method="post">
                @csrf
                <div class="form-group">
                    {{-- <label for="recipient-name" class="col-form-label">ID User:</label>
                    --}}
                    <input type="hidden" class="form-control txt" id="recipient-name" name="id">
                </div>
                <div class="form-group">
                    <label for="id_barang" class="col-form-label">ID Barang :</label>
                    <input type="text" class="form-control txt" id="name" name="id_barang">
                </div>
                <div class="form-group">
                    <label for="name" class="col-form-label">Nama Barang :</label>
                    <input type="text" class="form-control txt" id="name" name="nama_barang">
                </div>
                <div class="form-group mb-4">
                    <label for="id_jenis" class="col-form-label">Jenis Barang :</label>
                    <select name="id_jenis" class="form-control" required>
                        <option value="" hidden>-- Pilih Jenis Barang --</option>
                        @foreach ($data_jenis as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>                                                    
                        @endforeach
                    </select>
                </div>
                
                <div class="input-group mb-2">
                    <label for="harga_grosir" class="col-form-label" style="padding-right : 20px">Harga Grosir / Eceran :</label>
                    <span class="input-group-text">
                      Rp
                    </span>
                    <input type="number" name="harga_grosir" class="form-control"  placeholder="Rp. 00.000"  autocomplete="off">
                </div>
                <div class="input-group mb-2">
                    <label for="harga_satuan" style="padding-right : 29px" class="col-form-label">Harga Satuan (Jual) :</label>
                    <span class="input-group-text">
                      Rp
                    </span>
                    <input type="number" name="harga_satuan" class="form-control"  placeholder="Rp. 11.111"  autocomplete="off">
                </div>
                <label for="stok" class="col-from-label mb-2">Stok :</label><br/>
                <div class="input-group">
                    <input type="number" name="stok" class="form-control" autocomplete="off">
                    <span class="input-group-text">
                      Pcs
                    </span>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary">Create Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- MODAL ADD END END --}}
        {{-- MODAL EDIT START --}}
        @foreach ($data_barang as $d)
        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    </div>
                    <div class="modal-body">
                        <form class="login-input" action="/barang/{{$d->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            {{-- <label for="recipient-name" class="col-form-label">ID User:</label>
                            --}}
                            <input value="{{ $d->id }}" type="hidden" class="form-control txt" id="recipient-name" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label  for="id_barang" class="col-form-label">ID Barang :</label>
                            <input value="{{ $d->id_barang }}" type="text" class="form-control txt" id="name" name="id_barang">
                        </div>
                        <div class="form-group">
                            <label  for="name" class="col-form-label">Nama Barang :</label>
                            <input value="{{ $d->nama_barang }}" type="text" class="form-control txt" id="name" name="nama_barang">
                        </div>
                        <div class="form-group mb-4">
                            <label for="id_jenis" class="col-form-label">Jenis Barang :</label>
                            <select name="id_jenis" class="form-control" required>
                                <option value="{{ $d->id_jenis }}">{{ $d->nama_jenis }}</option>
                                @foreach ($data_jenis as $b)
                                <option value="{{ $b->id }}">{{ $b->nama_jenis }}</option>                                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <label style="padding-right : 20px" for="harga_grosir" class="col-form-label mr-3">Harga Grosir / Eceran :</label>
                            <span class="input-group-text">
                              Rp
                            </span>
                            <input value="{{ $d->harga_grosir }}" type="number" name="harga_grosir" class="form-control"  placeholder="Rp. 00.000"  autocomplete="off">
                        </div>
                        <div class="input-group mb-2">
                            <label style="padding-right : 29px" for="harga_satuan" class="col-form-label mr-2">Harga Satuan (Jual) :</label>
                            <span class="input-group-text">
                              Rp
                            </span>
                            <input value="{{ $d->harga_satuan }}" type="number" name="harga_satuan" class="form-control"  placeholder="Rp. 11.111"  autocomplete="off">
                        </div>
                        <label for="stok" class="col-form-label">Stok</label>
                        <div class="input-group">
                            <input value="{{ $d->stok }}" type="number" name="stok" class="form-control" autocomplete="off">
                            <span class="input-group-text">
                              Pcs
                            </span>
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
@endforeach
        {{-- Edit --}}
        {{-- MODAL EDIT END END --}}
 {{-- MODAL DELETE --}}
 
{{-- @endforeach --}}
    {{-- MODAL DELETE END END --}}

        {{-- KUMPULAN MODAL END END  --}}
        

        
@endsection
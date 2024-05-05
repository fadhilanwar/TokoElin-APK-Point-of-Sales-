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
                    <button data-bs-toggle="modal" data-bs-target="#cartPasok" class="btn btn-success w-25">
                       List Belanja
                    </button>
                   
                  </div>
                  <form action="/pasokbarang/{{ $post->id }}" method="post">
                    @csrf
                {{-- <div class="row">
                    
                    <div class="col md-6">
                        <label for="id_pasok" class="col-form-label">ID Pasok :</label>
                    <input style="background: #eee" value="PN-0001" type="text" class="form-control txt" name="id_pasok" readonly>
                    </div>
                    <div class="col md-6">
                        <label for="id_jenis" class="col-form-label">Supplier Tujuan :</label>
                        <select name="id_supplier" class="form-control" required>
                            <option value="" hidden>-- Pilih Supplier Tujuan --</option>
                        @foreach ($data_supplier as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_supplier }}</option>                                                    
                        @endforeach
                        </select>
                    </div>
                    
                </div> --}}
                
                <div class="row mb-4 mt-4">
                    <h2>
                        Identitas Barang
                    </h2>
                    
                    
                    <div class="col md-4">
                      {{-- HIDDEN FIELD START --}}
                      {{-- ID --}}
                      <input value="{{ $post->id }}" type="hidden" class="form-control txt" name="id">
                      {{-- Harga Grosir --}}
                      <input value="{{ $post->harga_grosir }}" type="hidden" class="form-control txt" name="harga_grosir">
                      {{-- HIDDEN FIELD END END --}}
                       <label class="col-form-label">Kode / ID Barang :</label>
                        <input value="{{ $post->id_barang }}" type="text" class="form-control txt" name="id_barang">

                      <label class="col-form-label">Nama Barang :</label>
                        <input value="{{ $post->nama_barang }}" type="text" class="form-control txt" name="nama_barang">
                    </div>
                    <div class="col md-4">
                        <label for="id_pasok" class="col-form-label">Qty :</label>
                        
                    <input type="number" class="form-control txt" name="qty" required>

                    <label for="id_pasok" class="col-form-label pb-4 mt-1">
                      {{-- //SPACE --}}
                    </label>

                   
                     <button type="submit" style="width: 100%" class="btn btn-info">Masukan List Belanja</button>
                    
                    </div>
                    {{-- <div class="col md-4">
                        <label for="id_pasok" class="col-form-label">Tanggal Pasok :</label>
                        <div class="input-icon">
                            <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                            </span>
                            <input name="tgl_transaksi" type="date" class="form-control" placeholder="Select a date" id="datepicker-icon-prepend" value=""/>
                          </div>
                    </div> --}}
                </div>
              </form>

               

            <div class="card">
              <div class="card-body">
                <div class="border-bottom py-3 mb-3">
                    <h3>
                        Data Barang
                    </h3>
                   
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
                                <th>ID</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>                                        
                                <th>Jenis</th>                                        
                                {{-- <th>Harga Grosir</th>                                        
                                <th>Harga Jual</th>                                         --}}
                                <th style="color: blue;"><b>Stok</b></th>                                        
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
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->id_barang }}</td>
                            <td>{{ $d->nama_barang }}</td> 
                            <td>{{ $d->nama_jenis }}</td>  
                            {{-- <td>Rp. {{ number_format($d->harga_grosir) }} / Pcs</td>  
                            <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>   --}}
                            <td style="font-size: 30px">
                              @if($d->stok < 10)
                                <span style="color: red">{{ $d->stok }}</span>
                                @else
                                <span style="color: black">{{ $d->stok }}</span>
                              @endif
                            </td>  
                            <td class="d-flex">
                                <form action="/pasokbarang/showPasok/{{ $d->id }}" method="get">
                                    <button class="btn btn-primary mr-2"><i class="fa fa-edit"></i>Tambah Stok</button>                                
                                </form>


                                    {{-- <button data-bs-toggle="modal" data-bs-target="#delete{{ $d->id }}" class="btn btn-danger">
                                      Hapus
                                   </button> --}}
                                   
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

 {{-- MODAL ADD START --}}
 <div class="modal modal-blur fade" id="cartPasok" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">List Belanja {{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="table-default" class="table-responsive">
                   
                    <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>ID</th> --}}
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>                                        
                                <th>Qty</th>                                        
                                <th>SubTotal</th>                                        
                                {{-- <th>Harga Grosir</th>                                        
                                <th>Harga Jual</th>                                         --}}
                                {{-- <th style="color: blue;"><b>Stok</b></th>                                         --}}
                                <th>Action</th>
                            </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($list_keranjang as $c)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $c->id_barang }}</td>
                            <td>{{ $c->nama_barang }}</td>
                            <td>Rp. {{ number_format($c->harga_grosir) }} / Pcs</td> 
                            <td>{{ $c->qty }}</td>  
                            <td>Rp. {{ number_format($c->subtotal) }}</td>  
                            {{-- <td>Rp. {{ number_format($d->harga_grosir) }} / Pcs</td>  
                            <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>   --}}
                            {{-- <td style="font-size: 30px">{{ $d->stok }}</td>   --}}
                            <td class="d-flex">
                                <form action="/pasokbarang/{{ $c->id }}/deleteFromCart" method="get">
                                    <button class="btn btn-danger mr-2"><i class="fa fa-edit"></i>Hapus List</button>                                
                                </form>


                                    {{-- <button data-bs-toggle="modal" data-bs-target="#delete{{ $d->id }}" class="btn btn-danger">
                                      Hapus
                                   </button> --}}
                                   
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

{{-- MODAL ADD END END --}}

                 
                
@endsection
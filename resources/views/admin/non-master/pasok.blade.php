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
                    <a href="/pasokbarang/add">
                        <button class="btn btn-info">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                          </svg>
                          <div style="padding-left: 5px">
                            {{ $title }}
                          </div>
                        </button>
                       
                    </a>
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
                                <th style="color: blue"><b>Stok</b></th>                                        
                                <th data-searchable="false">Action</th>
                            </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    <tbody class="table-tbody">
                        @foreach ($data_pasok as $d)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->id_barang }}</td>
                            <td>{{ $d->nama_barang }}</td> 
                            <td>{{ $d->nama_jenis }}</td>  
                            {{-- <td>Rp. {{ number_format($d->harga_grosir) }} / Pcs</td>  
                            <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>   --}}
                            <td style="font-size: 30px;">
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
                        <div class="modal modal-blur fade" id="delete{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
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
                 
                
@endsection
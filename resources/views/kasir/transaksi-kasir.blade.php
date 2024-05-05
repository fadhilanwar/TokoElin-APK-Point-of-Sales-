@extends('kasir.main-kasir')
@section('page-wrapper')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Transaksi > List {{ $title }}
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
                        <button data-bs-toggle="modal" data-bs-target="#cart" class="btn btn-success w-25">
                            Tambah Keranjang
                        </button>

                        <form action="/transaksi" method="post">
                            @csrf

                            <div class="row">
                                <div class="col md-6">
                                    <label for="id_pasok" class="col-form-label">No Transaksi :</label>
                                    <input style="background: #eee" value="{{ $kodeTrans }}" placeholder="Belum Kode Auto (PN-0000)" type="text" class="form-control txt"
                                        name="id_pasok" readonly>
                                </div>
                                <div class="col md-6">
                                    <label for="id_jenis" class="col-form-label">Status Pembayaran :</label>
                                   <input class="form-control txt" type="text" name="status_pembayaran" id="status_pembayaran">
                                </div>
        
                            </div> 
        
                            <div class="row mb-4 mt-4">
                               
                                <div class="col md-4">
                                    <label class="col-form-label">Total Bayar :</label>
                                    <input value="{{ $total_belanja }}" style="background: #eee" type="text" class="form-control txt" name="total_bayar" id="total_bayar" readonly>
                                    <label class="col-form-label">Uang Kembalian :</label>
                                    <input value="0" style="background: #eee" type="text" class="form-control txt" name="kembalian" id="kembalian" readonly>
                                </div>
                                <div class="col md-4">
                                    <label for="id_pasok" class="col-form-label">Uang Pembeli (Diterima)* :</label>
                                    <input value="" onkeyup="hitungKembalian()" type="number" class="form-control txt" name="uang_pembeli" id="uang_keluar" required>
                                    <label for="id_pasok" class="col-form-label pb-4 mt-1">
                                        {{-- //SPACE --}}
                                      </label>
                                    <button type="submit" style="width: 100%" class="btn btn-info">Bayar !</button>


                                </div>
                                {{-- <div class="col md-4">
                                    <label for="id_pasok" class="col-form-label">Tanggal Pasok :</label>
                                    <div class="input-icon">
                                        <span
                                            class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </span>
                                        <input value="" type="date" class="form-control" placeholder="Select a date"
                                            id="datepicker-icon-prepend" />
                                    </div>
                                </div> --}}
                           </div>
                        </form>

                    </div>
                   


                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom py-3 mb-3">
                                <h3>
                                    Keranjang Belanja
                                </h3>

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
                                                    <td>Rp. {{ number_format($c->harga_satuan) }} / Pcs</td>
                                                    <td>{{ $c->qty }}</td>
                                                    <td>Rp. {{ number_format($c->subtotal) }}</td>
                                                    {{-- <td>Rp. {{ number_format($d->harga_grosir) }} / Pcs</td>  
                                  <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>   --}}
                                                    {{-- <td style="font-size: 30px">{{ $d->stok }}</td>   --}}
                                                    <td class="d-flex">
                                                        <form action="/transaksi/{{ $c->id }}/edit" method="get">
                                                            <button class="btn btn-sm btn-primary mr-2"><i
                                                                    class="fa fa-edit"></i>Edit QTY</button>
                                                        </form>
    
                                                        <form action="/transaksi/{{ $c->id }}/DFCart" method="get">
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                Hapus List
                                                            </button>
                                                        </form>
    
                                                    </td>
    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

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
                            
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL ADD START --}}
            <div class="modal modal-blur fade" id="cart" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <h2>
                                - List Barang Toko Elin -
                            </h2>
                   
                        <div class="border-bottom mb-3">

                        </div>

                        <div id="table-default" class="table-responsive">

                            <table id="table_keranjang" class="display table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>ID Jenis</th>
                                        <th>Harga Jual</th>                                        
                                        <th style="color: blue;"><b>Stok</b></th>
                                        <th>Qty</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody class="table-tbody">
                                    @foreach ($data_barang as $d)
                                    @csrf
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->id_barang }}</td>
                                        <td>{{ $d->nama_barang }}</td>
                                        <td>{{ $d->id_jenis }}</td>
                                        <td>Rp. {{ number_format($d->harga_satuan) }} / Pcs</td>  
                                        <td>{{ $d->stok }}</td>
                                        <form action="/transaksi/addToCart/{{ $d->id }}" method="get">
                                            <td><input type="number" name="qty" id="qty"></td>
                                            <td>
                                                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-edit"></i>Add cart</button>
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
            </div>

            {{-- MODAL ADD END END --}}



           

            <script>
                function hitungKembalian()
                {
                    var uangKeluar = document.getElementById("uang_keluar").value;
                    var totalBayar = document.getElementById("total_bayar").value;

                    if (isNaN(uangKeluar)) {
                        document.getElementById("uang_keluar").value = "";
                        alert("Nilai Inputan Kamu Harus Berupa Angka !");
                        return;
                    }
                    if (isNaN(totalBayar)) {
                        document.getElementById("total_bayar").value = "";
                        alert("Nilai Inputan Kamu Harus Berupa Angka !");
                        return;
                    }
                    if (uangKeluar === "0") {
                        document.getElementById("uang_keluar").value = "";
                        alert("Inputan Tidak Boleh dimulai dari Angka 0 !");
                        return;
                    }

                  


                    var kembalian = parseInt(uangKeluar) - parseInt(totalBayar);

                    document.getElementById("kembalian").value = kembalian;
                }
            </script>
        @endsection

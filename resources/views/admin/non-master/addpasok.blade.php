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
                            <img src="/icon/box.png"> 
                            <div style="padding-left: 5px">
                                Box Belanjaan
                            </div>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom py-3 mb-3">
                                <h3>
                                    Data Barang
                                </h3>
                            </div>
                            <div id="table-default" class="table-responsive">

                                <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th style="color: blue;"><b>Stok</b></th>
                                            <th>Action</th>
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
                                                <td style="font-size: 30px">
                                                    @if($d->stok < 10)
                                                    <span style="color: red">{{ $d->stok }}</span>
                                                    @else
                                                    <span style="color: black">{{ $d->stok }}</span>
                                                  @endif
                                                </td>
                                                <td class="d-flex">
                                                    <form action="/pasokbarang/showPasok/{{ $d->id }}"
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



            {{-- MODAL ADD START --}}
            <div class="modal modal-blur fade" id="cartPasok" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">List Belanja {{ $title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <form action="/pasokbarang/checkout" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col md-6">
                                        <label for="id_pasok" class="col-form-label">ID Pasok :</label>
                                        <input style="background: #eee" value="{{ $kodePasok }}" placeholder="Belum Kode Auto (PN-0000)" type="text" class="form-control txt"
                                            name="id_pasok" readonly>
                                    </div>
                                    <div class="col md-6">
                                        <label for="id_jenis" class="col-form-label">Supplier Tujuan :</label>
                                        <select name="nama_supplier" class="form-control" required>
                                            <option value="" hidden>-- Pilih Supplier Tujuan --</option>
                                            @foreach ($data_supplier as $b)
                                                <option value="{{ $b->nama_supplier }}">{{ $b->nama_supplier }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="row mb-4 mt-4">
                                    <div class="col md-4">
                                        <label class="col-form-label">Total Belanja :</label>
                                        <input value="{{ $total_belanja }}" style="background: #eee" type="text" class="form-control txt" name="total_bayar" id="total_bayar" readonly>
                                        <label class="col-form-label">Uang Kembalian :</label>
                                        <input value="0" style="background: #eee" type="text" class="form-control txt" name="kembalian" id="kembalian" readonly>
                                    </div>
                                    <div class="col md-4">
                                        <label for="id_pasok" class="col-form-label">Uang Keluar(Membayar)* :</label>
                                        <input value="" onkeyup="hitungKembalian()" type="number" class="form-control txt" name="uang_keluar" id="uang_keluar">
                                        <label for="id_pasok" class="col-form-label pb-4 mt-1">
                                            {{-- //SPACE --}}
                                          </label>
                                        <button type="submit" style="width: 100%" class="btn btn-info">Checkout</button>
                                    </div>
                               </div>
                            </form>
                                   <h2>
                                       - List Belanja -
                                   </h2>
                               <div class="border-bottom">
                            </div>
                            <div id="table-default" class="table-responsive">
                                <table id="table_id" class="display table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Satuan (grosir)</th>
                                            <th>Qty</th>
                                            <th>SubTotal</th>
                                            <th data-searchable="false">Action</th>
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
                                                <td class="d-flex">
                                                    <form action="/pasokbarang/{{ $c->id }}/edit" method="get">
                                                        <button class="btn btn-sm btn-primary mr-2"><i
                                                                class="fa fa-edit"></i>Edit QTY</button>
                                                    </form>
                                                    <form action="/pasokbarang/{{ $c->id }}/deleteFromCart">
                                                        <button class="btn btn-sm btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293 6.854 8.146z"/>
                                                              </svg>
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

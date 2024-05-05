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
                        <div class="row">
                            <h3>
                                Cetak Per Tanggal
                            </h3>
                            <div class="col-md-6">
                                <form action="/rekap/cari" method="post">
                                    @csrf
                                <input type="date" name="tgl_awal"> Sampai
                                <input type="date" name="tgl_akhir">
                                <button type="submit" class="btn btn-warning">Cari Data</button>
                                </form>
                            </div>
                            <a href="/cetakPenjualan" target="_blank"><button class="btn btn-success">Cetak Data</button></a>
                            {{-- <div class="col-md-6">
                                <a href="/rekap">
                                    <button  class="btn btn-info">Refresh</button>
                                </a>
                            </div> --}}

                        </div>
                    </div>
                   

                    <div id="table-default" class="table-responsive">

                        <table id="table_supp" class="display table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Trans</th>
                                    <th>Tanggal Jual</th>
                                    <th>Total Bayar</th>
                                    {{-- <th>Uang Pembeli</th> --}}
                                    <th>Kembalian</th>
                                    <th data-searchable="false">Action</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody class="table-tbody">
                                @foreach ($penjualanDetail as $d)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $d->no_transaksi }}</td>
                                        <td>{{ $d->tgl_transaksi }}</td>
                                        <td>{{ $d->total_bayar }}</td>
                                        {{-- <td>{{ $d->uang_diterima }}</td> --}}
                                        <td>{{ $d->kembalian }}</td>
                                        <td class="d-flex">
                                            <button data-bs-toggle="modal" data-bs-target="#detail{{ $d->no_transaksi }}"
                                                style="margin-right: 10px" class="btn btn-primary mr-2"><i
                                                class="fa fa-edit"></i>Detail</button>
                                                 
                                                <form action="/rekap/detail/{{ $d->no_transaksi }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info mr-2"><i class="fa fa-edit"></i>Detail Asli</button>
                                                </form>

                                            <button class="btn btn-success">
                                                Cetak
                                            </button>

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

    {{-- KUMPULAN MODAL --}}
    
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

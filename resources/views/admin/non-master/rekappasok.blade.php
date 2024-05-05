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
                        <div class="row bg-">
                            <h3>
                                Cetak Per Tanggal
                            </h3>
                            <div class="col-md-4">
                                <form action="/pasok/cari" method="post">
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

                                   <a href="/cetakAllPasok" target="_blank"><button class="btn btn-success w-100">Cetak Keseluruhan</button></a>
                               </div>
                               <div class="col md-4"></div>
                               <div class="col md-4">
                               </div>
                              
                            </div>
                    </div>
                   

                    <div id="table-default" class="table-responsive">

                        <table id="table_supp" class="display table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Pasok</th>
                                    <th>Supplier</th>
                                    <th>Tanggal</th>
                                    <th>Total Belanja</th>
                                    <th>Uang Keluar</th>
                                    <th data-searchable="false">Action</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody class="table-tbody">
                                @foreach ($pasok_all as $d)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                            <td>{{ $d->id_pasok }}</td>
                                            <td>{{ $d->supplier_tujuan }}</td>
                                            <td>{{ $d->tgl_transaksi }}</td>  
                                            <td>{{ $d->total_bayar }}</td>  
                                            <td>{{ $d->uang_keluar }}</td> 

                                        <td class="d-flex">

                                            <form  action="showDetailPasok/{{ $d->id_pasok }}" method="get">

                                                <button
                                                    style="margin-right: 10px" class="btn btn-primary mr-2"><i
                                                    class="fa fa-edit"></i>Detail Belanja</button>
                                                </form>
                                                {{-- <button
                                                    style="margin-right: 10px" class="btn btn-danger mr-2"><i
                                                    class="fa fa-edit"></i>Retur Barang</button>
                                                 --}}
            

                                        </td>
                                    </tr>
                                    <div class="modal modal-blur fade" id="delete{{ $d->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="modal-status bg-danger"></div>
                                                <div class="modal-body text-center py-4">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon mb-2 text-danger icon-lg" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                                        <path d="M12 9v4" />
                                                        <path d="M12 17h.01" />
                                                    </svg>
                                                    <h3>Are you sure?</h3>
                                                    <div class="text-muted">Aksi ini akan menghapus Supplier dengan Nama
                                                        ({{ $d->nama_supplier }})
                                                        dari Data Anda...</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="w-100">
                                                        <div class="row">
                                                            <div class="col"><a href="#" class="btn w-100 mb-2"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </a></div>
                                                            <form method="get"
                                                                action="{{ url('/datasupplier/destroy/' . $d->id) }}">
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

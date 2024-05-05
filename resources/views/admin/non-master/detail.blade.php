@extends('admin.main-admin')
@section('page-wrapper')
 <!-- Page header -->
 <<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Invoice / Detail Transaksi
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <a href="/transaksiSelesai">
                <button class="btn btn-info">Kembali</button>
            </a>

          <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
            Print Struk
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="card card-lg">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
                
              <p class="h2">Toko Elin.</p>
              <table border="0">
                @foreach ($penjualanHead as $head)
                    
                <tr>
                    <td>No Transaksi</td>
                    <td>: {{ $head->no_transaksi }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: {{ $head->tgl_transaksi }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>: {{ $head->kasir }}</td>
                </tr>
               
               
            </table>              
        </div>
        <div class="col-6 text-end">
            <p class="h3">Kepada Yth. Pembeli</p>
            <p class="h4">{{ $head->nama_pembeli }}</p>
        </div>
        <div class="col-12 my-5">
            <h1>{{ $head->no_transaksi }}</h1>
            @endforeach
            </div>
          </div>
          <table class="table table-transparent table-responsive">
            <thead>
              <tr>
                <th class="text-center" style="width: 1%"></th>
                <th>Nama Barang</th>
                <th class="text-center" style="width: 1%">Harga Satuan</th>
                <th class="text-end" style="width: 1%">Qty</th>
                <th class="text-end" style="width: 1%">SubTotal</th>
              </tr>
            </thead>
            @php
            $noUrut = 1;
            @endphp
            @foreach ($penjualan as $item)
                
            <tr>
                <td class="text-center">{{ $noUrut++ }}</td>
              <td>
                <p class="strong mb-1">{{ $item->nama_barang }}</p>
                <div class="text-muted">{{ $item->id_barang }}</div>
              </td>
              <td class="text-center">
                Rp. {{ number_format($item->harga_satuan) }} / Pcs
              </td>
              <td class="text-end">{{ $item->qty }}x</td>
              <td class="text-end">Rp. {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
            
            @foreach ($penjualanHead as $head)

            <tr>
              <td colspan="4" class="strong text-end">Total Belanja</td>
              <td class="text-end">{{ number_format($item->total_bayar) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="strong text-end">Terbayar</td>
                <td class="text-end">{{ number_format($item->uang_diterima) }}</td>
              </tr>
          
            <tr>
              <td colspan="4" class="strong text-end">Kembali</td>
              <td class="text-end">{{ number_format($item->kembalian) }}</td>
            </tr>
            @endforeach
          </table>
          <p class="text-muted text-center mt-5">Terimakasih Sudah Berbelanja di Toko Elin ... Kembali lagi Esok :)</p>
        </div>
      </div>
    </div>
  </div>


        
      
@endsection
{{--  --}}

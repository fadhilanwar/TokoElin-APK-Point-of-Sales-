<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\PasokTransaksi;
use App\Models\PasokDetail;
use App\Models\bon;
use Illuminate\Support\Facades\DB;



class Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Rekap Penjualan';
        $penjualan = Transaksi::all();
        $penjualanDetail = DB::table('detail_transaksi')
        ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->join('databarang', 'databarang.id_barang', '=', 'detail_transaksi.id_barang')
        ->select('detail_transaksi.no_transaksi', 'transaksi.tgl_transaksi', 'transaksi.total_bayar', 'databarang.nama_barang', 'detail_transaksi.harga_satuan',
         'detail_transaksi.qty', 'detail_transaksi.subtotal')
         ->get();

        return view('admin.non-master.laporan')->with([
            'title' => $title,
            'penjualanDetail' => $penjualanDetail 
        ]);
    }
    public function rekapJual()
    {
        $title = 'Rekap Penjualan';
        $penjualan = Transaksi::all();
        $penjualanDetail = DB::table('detail_transaksi')
        ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->join('databarang', 'databarang.id_barang', '=', 'detail_transaksi.id_barang')
        ->select('detail_transaksi.no_transaksi', 'transaksi.tgl_transaksi', 'transaksi.total_bayar', 'databarang.nama_barang', 'detail_transaksi.harga_satuan',
         'detail_transaksi.qty', 'detail_transaksi.subtotal')
         ->get();

        return view('admin.non-master.laporan')->with([
            'title' => $title,
            'penjualanDetail' => $penjualanDetail 
        ]);
    }
    public function rekapPasok()
    {
        $title = 'Rekap Pasok';
        $penjualan = PasokTransaksi::all();
        $penjualanDetail = DB::table('detail_transaksi')
        ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->join('databarang', 'databarang.id_barang', '=', 'detail_transaksi.id_barang')
        ->select('detail_transaksi.no_transaksi', 'transaksi.tgl_transaksi', 'transaksi.total_bayar', 'databarang.nama_barang', 'detail_transaksi.harga_satuan',
         'detail_transaksi.qty', 'detail_transaksi.subtotal')
         ->get();

        return view('admin.non-master.laporan')->with([
            'title' => $title,
            'penjualanDetail' => $penjualanDetail 
        ]);
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

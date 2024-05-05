<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\PasokTransaksi;
use App\Models\Detail;
use App\Models\bon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;  


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Rekap Penjualan';
        return view('admin.non-master.laporan')>with([
            'title' => $title
        ]);
    }

    public function transaksiSelesai(){
        $penjualanAll = Transaksi::all();
        $data_detail = Detail::join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->select('transaksi.*', 'detail_transaksi.id_barang', 'detail_transaksi.nama_barang', 'detail_transaksi.harga_satuan', 'detail_transaksi.qty', 'detail_transaksi.subtotal')
        ->get();


        return view('admin.non-master.rekap')->with([
            'title' => 'Rekap Penjualan',
            'penjualan' => $penjualanAll,
            'data_detail' => $data_detail
        ]);
    }

    public function cetakAllPenjualan() 
    {
        // $penjualanAll = Transaksi::all();
        // $penjualanAll = DB::table('detail_transaksi')
        //             ->join('databarang', 'databarang.id_barang', '=','detail_transaksi.id_barang')
        //             ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        //             ->select('transaksi.*', 'databarang.harga_grosir', 'detail_transaksi.id_barang', 'detail_transaksi.harga_satuan', 'detail_transaksi.qty', 'detail_transaksi.subtotal')
        //             ->get();

        $penjualanAll = Transaksi::all();

        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');

        $penjualanLaba = DB::table('detail_transaksi')
                             ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select(DB::raw('sum(laba) as total_laba'))
                            ->get();

                            $total_laba = $penjualanLaba[0]->total_laba;


        return view('admin.laporan.cetak-penjualan')->with([
            'title' => 'Cetak Penjualan',
            'penjualan' => $penjualanAll,
            'penjualanLaba' => $total_laba,
            'date' => $date
        ]);
    }
    public function cetakAllPasok() 
    {
        // $penjualanAll = Transaksi::all();
        // $penjualanAll = DB::table('detail_transaksi')
        //             ->join('databarang', 'databarang.id_barang', '=','detail_transaksi.id_barang')
        //             ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        //             ->select('transaksi.*', 'databarang.harga_grosir', 'detail_transaksi.id_barang', 'detail_transaksi.harga_satuan', 'detail_transaksi.qty', 'detail_transaksi.subtotal')
        //             ->get();

        $pasokAll = PasokTransaksi::all();
        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');


        $pengeluaranPasok = DB::table('pasok_transaksi')
                            ->select(DB::raw('sum(total_bayar) as total_pengeluaran'))
                            ->get();

                            $total_pengeluaran = $pengeluaranPasok[0]->total_pengeluaran;


        return view('admin.laporan.cetak-pasok')->with([
            'title' => 'Cetak Pasok',
            'pasokAll' => $pasokAll,
            'pengeluaran' => $total_pengeluaran,
            'date' => $date
        ]);
    }

    public function cetakAllBon(Request $request) 
    {
        // $status = $request->get('    status');
        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');

        $status = $request->status;
        if ($status == "") {
            $bonAll = bon::all();
        } else {
            $bonAll = bon::where('status_pembayaran', '=', $status)->get();
        }

      

        return view('admin.laporan.cetak-bon')->with([
            'title' => 'Cetak Data Bon',
            'bon' => $bonAll,
            'date' => $date
            // 'penjualanLaba' => $total_laba
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bon;
use App\Models\Transaksi;
use Carbon\Carbon;
use DB;


class BonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bonAll = bon::all();
        $title = 'Bon';
        return view('admin.non-master.bon')->with([
            'bon' => $bonAll,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter(Request $request)
    {
        $status = $request->get('status');
        $bon = bon::where('status_pembayaran', '=', $status)->get();

        return response()->json($bon);
    }

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
    public function update(Request $request, bon $databon, $id)
    {
        // $databon = $databon->find($id);
        
        // if ($databon->sisa_bayar < $request->bayar) {
        //     alert()->error('Jangan Bro !', 'Uang Pelunasannya Lebih...');
        // } else {

        //     $databon->id_bon = $request->id_bon;
        //     $databon->no_transaksi = $request->no_transaksi;
        //     $databon->nama_pembeli = $request->nama_pembeli;
        //     $databon->sisa_bayar = $request->sisa_bayar + $request->bayar;
        //     $databon->status_pembayaran = $request->status_pembayaran;
        //     $databon->update();

        // }

        // if ($databon->sisa_bayar == 0) {
        //     $databon->status_pembayaran = 'Lunas';
        //     $databon->update();
            
        // }

        // alert()->success('Sukses Bro !', 'Hutang Berhasil Dibayar');


        return redirect('/jadjnanjan');
    }
    public function bayarHutang(Request $request, bon $databon, $id)
    {
        $databon = $databon->find($id);
        $tglBayar = Carbon::parse()->setTimezone('Asia/Jakarta')->format('Y-m-d');

    

            $databon->id_bon = $request->id_bon;
            $databon->no_transaksi = $request->no_transaksi;
            $databon->nama_pembeli = $request->nama_pembeli;
            $databon->sisa_bayar = $request->sisa_bayar + $request->bayar;
            $databon->status_pembayaran = $request->status_pembayaran;
            $databon->update();

            alert()->success('Sukses Bro !', 'Perubahan Berhasil Diterapkan...');
        
        if ($databon->sisa_bayar >= 0) {
            $databon->id_bon = $request->id_bon;
            $databon->no_transaksi = $request->no_transaksi;
            $databon->nama_pembeli = $request->nama_pembeli;
            $databon->sisa_bayar = $request->sisa_bayar + $request->bayar;
            $databon->status_pembayaran = 'Lunas';
            $databon->update();

             // MASUKAN KE TABEL HEAD
            $transaksi = new Transaksi();
            // $transaksi->id = $request->id;
            $transaksi->no_transaksi = $request->no_transaksi;
            // $transaksi->id_supplier = $request->id_supplier;
            $transaksi->tgl_transaksi = $tglBayar;
            $transaksi->kasir = $request->kasir;
            $transaksi->total_bayar = $request->total_bayar;
            $transaksi->uang_diterima = $request->total_bayar;
            $transaksi->kembalian = 0;
            $transaksi->nama_pembeli = $request->nama_pembeli;
            $transaksi->save();

            
        }

        if ($databon->sisa_bayar > 1) {
            alert()->success('Terimakasih  !', 'Sudah Melebihkan Sedikit :)');

        }



        return redirect('/bon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBon($id)
    {
        bon::where('id', $id)->delete();

        alert()->warning('Terhapus Bro !', 'Bon Berhasil Terhapus');


        return redirect('/bon')->with('Success', 'Data Bon Berhasil di-Hapus');
    }
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\bon;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::all();
        
        $nama_jenis =  $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();

        $list = Keranjang::all();

        //Hitung SubTotal SUM()
        $total_belanja = DB::table('keranjang')->sum('subtotal');
        
        $kodeTransaksiAuto = "NT-" . Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        
        return view('admin.non-master.transaksi')->with([
        'title' => 'Transaksi',
        'data_barang' => $data,
        'data_jenis' => $nama_jenis,
        'list_keranjang' => $list,
        'total_belanja' => $total_belanja,
        'kodeTrans' => $kodeTransaksiAuto

        // 'search' => $search
        ]);
      
    }
    public function indexKasir()
    {
        $data = Barang::all();
        
        $nama_jenis =  $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();

        $list = Keranjang::all();

        //Hitung SubTotal SUM()
        $total_belanja = DB::table('keranjang')->sum('subtotal');
        
        $kodeTransaksiAuto = "NT-" . Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        
        return view('kasir.transaksi-kasir')->with([
        'title' => 'Transaksi',
        'data_barang' => $data,
        'data_jenis' => $nama_jenis,
        'list_keranjang' => $list,
        'total_belanja' => $total_belanja,
        'kodeTrans' => $kodeTransaksiAuto
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
    public function addToCart(Request $request, Barang $a, $id)
    {
       
        $barang = $a->find($id);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('keranjang')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->count();
        if ($request->qty == 0) {
            alert()->error('Gagal !', 'Qty harus > 1');

        } else {

        if ($request->qty > $barang->stok) {
            alert()->error('Gagal !', 'Stok Barang Kurang');
        } else {

        // TAMBAH BARANG JIKA BELUM TERLIST DI KERANJANG
        if ($count == 0) {
            $keranjang = new Keranjang();
            $keranjang->id = $barang->id;
            $keranjang->id_barang = $barang->id_barang;
            $keranjang->nama_barang = $barang->nama_barang;
            $keranjang->harga_grosir = $barang->harga_grosir;
            $keranjang->harga_satuan = $barang->harga_satuan;
            $keranjang->qty = $request->qty;
            $keranjang->subtotal = $request->qty * $barang->harga_satuan;
            $keranjang->laba = ($barang->harga_satuan - $barang->harga_grosir) * $request->qty;
            $keranjang->save();

            // TAMBAH QTY JIKA SUDAH TERLIST DI KERANJANG
            } else {
            $qry = DB::table('keranjang')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->get();

                        foreach ($qry as $query) {
                           
                            alert()->error('Gagal !', 'Barang Ini Sudah ada di Keranjang');

                        }
                    }
                }
            }   
 
        return redirect('/transaksi');
    }

 
    public function DFC($id)
    {
        Keranjang::where('id', $id)->delete();

        alert()->warning('Terhapus Bro !', 'Barang Dihapus Dari Keranjang');

        return redirect('/transaksi')->with('Success', 'Data Barang Berhasil di-Hapus');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $qtyBarang = Barang::all();
        $kodeAutoTrans = "NT-" .  Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $kodeBon = "BON-" .  Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $tglTrans = Carbon::parse()->setTimezone('Asia/Jakarta')->format('Y-m-d');

        $keranjang = DB::table('keranjang')->get();
        foreach ($keranjang as $krj) {
            DB::table('databarang')->where('id_barang', '=', $krj->id_barang)->decrement('stok', $krj->qty);
        }

        if ($request->total_bayar == 0) {
            alert()->error('Gagal !', 'Keranjang Belum Terisi ...');
        } else {


        if ($request->uang_pembeli < $request->total_bayar) {

             // MASUKAN KE TABEL BON
            $bon = new bon();
            $bon->id_bon = $kodeBon;
            $bon->no_transaksi = $kodeAutoTrans;
            $bon->tgl_transaksi = $tglTrans;
            $bon->nama_pembeli = $request->nama_pembeli;
            $bon->total_bayar = $request->total_bayar;
            $bon->sisa_bayar = $request->kembalian;
            $bon->status_pembayaran = 'Belum Lunas';
            $bon->save();

                // MASUKAN KE TABEL DETAIL
                DB::statement("INSERT into detail_transaksi (no_transaksi, id_barang, nama_barang, harga_grosir, harga_satuan, qty, subtotal, laba)
                SELECT '$kodeAutoTrans', id_barang, nama_barang, harga_grosir, harga_satuan, qty, subtotal, laba FROM keranjang");

                DB::table('keranjang')->truncate();

            return redirect('/bon');

        } else {

                // MASUKAN KE TABEL HEAD
                $transaksi = new Transaksi();
                // $transaksi->id = $request->id;
                $transaksi->no_transaksi = $kodeAutoTrans;
                // $transaksi->id_supplier = $request->id_supplier;
                $transaksi->tgl_transaksi = $tglTrans;
                $transaksi->kasir = $request->kasir;
                $transaksi->total_bayar = $request->total_bayar;
                $transaksi->uang_diterima = $request->uang_pembeli;
                $transaksi->kembalian = $request->kembalian;
                $transaksi->nama_pembeli = $request->nama_pembeli;
                $transaksi->save();

                // MASUKAN KE TABEL DETAIL
                DB::statement("INSERT into detail_transaksi (no_transaksi, id_barang, nama_barang, harga_grosir, harga_satuan, qty, subtotal, laba)
                SELECT '$kodeAutoTrans', id_barang, nama_barang, harga_grosir, harga_satuan, qty, subtotal, laba FROM keranjang");

                DB::table('keranjang')->truncate();

                alert()->success('Transaksi Sukses !', 'Jangan Lupa ucapkan Terimakasih :)');

                return redirect('showDetail/'. $kodeAutoTrans  );
            }

        }
        
    }

    public function editQTY(Request $request, Barang $a, $id)
    {

        $barang = $a->find($id);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('keranjang')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->count();
         if ($request->qty == 0) {

            alert()->error('Gagal !', 'Qty harus > 1');

         } else {

        if ($request->qty > $barang->stok) {
            alert()->error('Gagal !', 'Stok Barang Kurang');
        } else {
        // TAMBAH BARANG JIKA BELUM TERLIST DI KERANJANG
        if ($count == 0) {
            $keranjang = new Keranjang();
            $keranjang->id = $request->id;
            $keranjang->id_barang = $request->id_barang;
            $keranjang->nama_barang = $request->nama_barang;
            $keranjang->harga_satuan = $request->harga_satuan;
            $keranjang->qty = $request->qty;
            $keranjang->subtotal = $request->qty * $request->harga_grosir;
            $keranjang->laba = ($barang->harga_satuan - $barang->harga_grosir) * $request->qty;
            $keranjang->save();

        // TAMBAH QTY JIKA SUDAH TERLIST DI KERANJANG
        } else {
            $qry = DB::table('keranjang')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->get();

                        foreach ($qry as $query) {
                            
                            DB::table('keranjang')->where('id_barang', "=", $barang->id_barang)->update([
                                'qty' => $request->qty,
                                'subtotal' => $barang->harga_satuan * $request->qty
                            ]);
                        }
            
            
                }
        }
    }

        return redirect('/transaksi');
        // return redirect('/yahaha-mau-edit-qty');
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

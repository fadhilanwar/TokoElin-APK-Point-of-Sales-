<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\KeranjangPasok;
use App\Models\PasokTransaksi;
use App\Models\PasokDetail;
use Carbon\Carbon;



class PasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $data_jenis = JenisBarang::all();
        $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
                                        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();
                                        
        $countstok = DB::table('databarang')
                      ->where('stok', "<", 5)
                      ->get();

       

        $nama_jenis =  $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();

        return view('admin.non-master.pasok')->with([
            'title' => 'Pasok Barang',
            'data_pasok' => $data,
            'data_jenis' => $nama_jenis,
            'count_stok' => $countstok,

            // 'search' => $search
        ]);
    }

    public function showPasok($id) 
    {
        $sup = Supplier::all();
        $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();
        $post = Barang::where('id', $id)->first();
        $list = KeranjangPasok::all();


       return view('admin.non-master.addpasokdata', compact('post'))->with([
        'title' => 'Pasok Barang',
        'data_barang' => $data,
        'data_supplier' => $sup,
        'list_keranjang' => $list
        // 'search' => $search
    ]);


        return redirect('/addpasok');
    }

    public function addPasok(Request $request) 
    {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga_satuan' => 'required',
            'qty' => 'required',
            'subtotal' => 'required'
        ]);

        $keranjang = new KeranjangPasok();
        $keranjang->id = $request->id;
        $keranjang->id_barang = $request->id_barang;
        $keranjang->nama_barang = $request->nama_barang;
        $keranjang->harga_grosir = $request->harga_grosir;
        $keranjang->qty = $request->qty;
        $keranjang->subtotal = $request->qty * $request->harga_grosir;
        $keranjang->save();

        $transaksi = new PasokTransaksi();
        $transaksi->id = $request->id;
        $transaksi->id_pasok = $request->id_pasok;
        $transaksi->id_supplier = $request->id_supplier;
        $transaksi->tgl_transaksi = $request->tgl_transaksi;
        // $transaksi->total_bayar = $request->total_bayar;
        // $transaksi->uang_keluar = $request->uang_keluar;
        // $transaksi->kembalian = $request->kembalian;
        $transaksi->save();

        $detail = new PasokDetail();
        $detail->id = $request->id;
        $detail->id_pasok = $request->id_pasok;
        $detail->id_barang = $request->id_barang;
        $detail->nama_barang = $request->nama_barang;
        $detail->harga_grosir = $request->alamat;
        $detail->qty = $request->qty;
        $detail->subtotal = $request->qty * $request->harga_grosir;
        $detail->save();



        return redirect('/pasokbarang/add');

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
    public function store(Request $request, Barang $a, $id)
    {
        // $request->validate([
        //     'id_barang' => 'required',
        //     'nama_barang' => 'required',
        //     'harga_satuan' => 'required',
        //     'qty' => 'required',
        //     'subtotal' => 'required'
        // ]);
        
        $barang = $a->find($id);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->count();
        
        if ($request->qty == 0) {
            alert()->error('Gagal Bro !', 'Belanja tidak bisa 0 Pcs');
        } else {

        // TAMBAH BARANG JIKA BELUM TERLIST DI KERANJANG
        if ($count == 0) {
            $keranjang = new KeranjangPasok();
            $keranjang->id = $request->id;
            $keranjang->id_barang = $request->id_barang;
            $keranjang->nama_barang = $request->nama_barang;
            $keranjang->harga_grosir = $request->harga_grosir;
            $keranjang->qty = $request->qty;
            $keranjang->subtotal = $request->qty * $request->harga_grosir;
            $keranjang->save();

        // TAMBAH QTY JIKA SUDAH TERLIST DI KERANJANG
        } else {
            $qry = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->get();

                        foreach ($qry as $query) {
                            $keranjang = new KeranjangPasok();
                            // $keranjang->id = $request->id;
                            // $keranjang->id_barang = $request->id_barang;
                            // $keranjang->nama_barang = $request->nama_barang;
                            // $keranjang->harga_grosir = $request->harga_grosir;
                            $keranjang->qty = $keranjang->qty + $request->qty;
                            $keranjang->subtotal =($keranjang->qty + $request->qty) * $request->harga_grosir;
                            $keranjang->update();
                        }
            
            
        }  
    }


       

        $list = KeranjangPasok::all();

        

        return redirect('/pasokbarang/add')->with([
            'list_keranjang' => $list
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
          // $sup = Supplier::all();
          $data = Barang::all();
          $post = Barang::where('id', $id)->first();
          $list =  KeranjangPasok::where('id', $id)->first();
          $listAll =  KeranjangPasok::all();
  
  
         return view('admin.non-master.editpasokdata')->with([
          'title' => 'Pasok Barang',
          'post' => $post,
          'data_barang' => $data,
          // 'data_supplier' => $sup,
          'list_keranjang' => $list,
          'list_keranjang_all' => $listAll
          // 'search' => $search
         ]);
    }

    public function editQTY(Request $request, Barang $a, $id)
    {
       // $request->validate([
        //     'id_barang' => 'required',
        //     'nama_barang' => 'required',
        //     'harga_satuan' => 'required',
        //     'qty' => 'required',
        //     'subtotal' => 'required'
        // ]);
        
        $barang = $a->find($id);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->count();
        
        // TAMBAH BARANG JIKA BELUM TERLIST DI KERANJANG
        if ($count == 0) {
            $keranjang = new KeranjangPasok();
            $keranjang->id = $request->id;
            $keranjang->id_barang = $request->id_barang;
            $keranjang->nama_barang = $request->nama_barang;
            $keranjang->harga_grosir = $request->harga_grosir;
            $keranjang->qty = $request->qty;
            $keranjang->subtotal = $request->qty * $request->harga_grosir;
            $keranjang->save();

        // TAMBAH QTY JIKA SUDAH TERLIST DI KERANJANG
        } else {
            $qry = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->get();

                        foreach ($qry as $query) {
                            // $keranjang = new KeranjangPasok();
                            // $keranjang->id = $request->id;
                            // $keranjang->id_barang = $request->id_barang;
                            // $keranjang->nama_barang = $request->nama_barang;
                            // $keranjang->harga_grosir = $request->harga_grosir;
                            // $keranjang->qty = $keranjang->qty + $request->qty;
                            // $keranjang->subtotal =($keranjang->qty + $request->qty) * $request->harga_grosir;
                            // $keranjang->update();

                            DB::table('keranjang_pasok')->where('id_barang', "=", $barang->id_barang)->update([
                                'qty' => $request->qty,
                                'subtotal' => $barang->harga_grosir * $request->qty
                            ]);
                        }
            
            
        }
        
        alert()->success('Berhasil DIubah !', 'Qty Barang Terubah');


        return redirect('/pasokbarang/add');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $a, $id)
    {
        // $request->validate([
        //     'id_barang' => 'required',
        //     'nama_barang' => 'required',
        //     'harga_satuan' => 'required',
        //     'qty' => 'required',
        //     'subtotal' => 'required'
        // ]);
        
        $barang = $a->find($id);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->count();
        
        
        if ($request->qty == 0) {
            alert()->error('Gagal Bro !', 'Belanja tidak bisa 0 Pcs');
        } else {
        // TAMBAH BARANG JIKA BELUM TERLIST DI KERANJANG
        if ($count == 0) {
            $keranjang = new KeranjangPasok();
            $keranjang->id = $request->id;
            $keranjang->id_barang = $request->id_barang;
            $keranjang->nama_barang = $request->nama_barang;
            $keranjang->harga_grosir = $request->harga_grosir;
            $keranjang->qty = $request->qty;
            $keranjang->subtotal = $request->qty * $request->harga_grosir;
            $keranjang->save();
            

        // TAMBAH QTY JIKA SUDAH TERLIST DI KERANJANG
        } else {
            $qry = DB::table('keranjang_pasok')
                        ->where('id_barang', "=", $barang->id_barang)
                        ->get();

                        foreach ($qry as $query) {
                           

                            DB::table('keranjang_pasok')->where('id_barang', "=", $barang->id_barang)->update([
                                'qty' => $query->qty + $request->qty,
                                'subtotal' => $barang->harga_grosir * ($query->qty + $request->qty)
                            ]);
                        }
            
            
        }
    }

       

       

        
        
        return redirect('/pasokbarang/add');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function DFC($id)
    {
        KeranjangPasok::where('id', $id)->delete();
        return redirect('/pasokbarang/add')->with('Success', 'Data Barang Berhasil di-Hapus');
    }

    public function checkOut(Request $request)
    {
        $qtyBarang = Barang::all();
        $kodePasok = "PN-" .  Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $tglPasok = Carbon::parse()->setTimezone('Asia/Jakarta')->format('Y-m-d');

        

        if ($request->uang_keluar < $request->total_bayar) {
            alert()->error('Gagal Bro !', 'Uang Tidak Cukup untuk membayar');

            // return redirect('/jnjksn');

        } else {

            $keranjang = DB::table('keranjang_pasok')->get();
        foreach ($keranjang as $krj) {
            DB::table('databarang')->where('id_barang', '=', $krj->id_barang)->increment('stok', $krj->qty);
        }

        // MASUKAN KE TABEL HEAD
        $transaksi = new PasokTransaksi();
        // $transaksi->id = $request->id;
        $transaksi->id_pasok = $kodePasok;
        $transaksi->supplier_tujuan = $request->nama_supplier;
        $transaksi->tgl_transaksi = $tglPasok;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->uang_keluar = $request->uang_keluar;
        $transaksi->kembalian = $request->kembalian;
        $transaksi->save();

        // MASUKAN KE TABEL DETAIL
        DB::statement("INSERT into pasok_detail (id_pasok, id_barang, nama_barang, harga_grosir, qty, subtotal)
        SELECT '$kodePasok', id_barang, nama_barang, harga_grosir, qty, subtotal FROM keranjang_pasok");



        

        DB::table('keranjang_pasok')->truncate();
        // return redirect('/Checkout-Berhasil');
    }
    alert()->success('Restok Sukses !', 'Restok berhasil dilakukan');


    return redirect('/pasokbarang');

        
    }
}

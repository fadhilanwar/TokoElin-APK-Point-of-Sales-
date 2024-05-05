<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\DB;



class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'title' => 'Data Barang',
            'data_jenis' => JenisBarang::all(),
            'data_barang' => Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
                                            ->select('databarang.*', 'jenisbarang.nama_jenis')->get()
        );

        return view('admin.non-master.barang', $data);
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
        $request->validate([
            'id_barang' => 'required',
            'id_jenis' => 'required',
            'nama_barang' => 'required',
            'harga_grosir' => 'required',
            'harga_satuan' => 'required',
            'stok' => 'required'
        ]);

        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $count = DB::table('databarang')
                        ->where('nama_barang', "=", $request->nama_barang)
                        ->count();
        if ($count > 0) {
            alert()->error('Tidak Ditambahkan !', 'Nama Barang serupa sudah ada...');

        }else if ($request->harga_grosir > $request->harga_satuan) {
            alert()->error('Gagal !', 'Tidak ada Profit yang didapat !');
        }
        else if ($request->stok < 0) {
            alert()->error('Negative?', 'Tidak ada Stok yang bisa Negatif !');
        } else{


        Barang::create([
            'id_barang' =>  $request->id_barang,
            'id_jenis' =>  $request->id_jenis,
            'nama_barang' =>  $request->nama_barang,
            'harga_grosir' =>  $request->harga_grosir,
            'harga_satuan' =>  $request->harga_satuan,
            'stok' =>  $request->stok
            
            
        ]);
    }


        
        echo'<script>
        alert("Data Barang Berhasil Ditambahkan")</script>';

        return redirect('/barang')->with('success', 'Data Berhasil di-simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $databarang, $id)
    {
        Barang::where('id', $id)->update([
            'id_barang' =>  $request->id_barang,
            'id_jenis' =>  $request->id_jenis,
            'nama_barang' =>  $request->nama_barang,
            'harga_grosir' =>  $request->harga_grosir,
            'harga_satuan' =>  $request->harga_satuan,
            'stok' =>  $request->stok
        ]);

        echo'<script>
        alert("Data Barang Berhasil Di-Ubah...")</script>';

        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Barang::where('id', $id)->delete();
        return redirect('/barang')->with('Success', 'Data Barang Berhasil di-Hapus');
    }
}

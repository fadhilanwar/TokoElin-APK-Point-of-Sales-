<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateJenisBarang;


class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisBarang::all();
        return view('admin.master.jenisbarang')->with([
            'title' => 'Data Jenis Barang',
            'datajenis' => $data
            // 'search' => $search
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
        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis
        ]);

        alert()->success('Sukses Bro !', 'Jenis Baru Berhasil Ditambahkan');


        return redirect('/datajenisbarang')->with('success', 'Data Berhasil di-simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisBarang $jenisBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBarang $jenisBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisBarang $request, JenisBarang $datajenis, $id)
    {
        JenisBarang::where('id', $id)->update([
            'nama_jenis' => $request->nama_jenis 
        ]);

        alert()->success('Sukses Bro !', 'Jenis Berhasil Diubah');


        return redirect('/datajenisbarang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        JenisBarang::where('id', $id)->delete();

        alert()->warning('Terhapus Bro !', 'Data Berhasil Terhapus');

        
        return redirect('/datajenisbarang')->with('Success', 'Kategori Berhasil di-Hapus');
    }
}

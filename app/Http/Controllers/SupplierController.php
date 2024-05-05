<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use Carbon\Carbon;
use Alert;



class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::all();
        return view('admin.master.datasupplier')->with([
            'title' => 'Data Supplier',
            'datasupplier' => $data
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
    public function store(StoreSupplierRequest $request)
    {
        // $request->validate([
        //     'id' => 'required',
        //     'nama_supplier' => 'required',
        //     'alamat'        => 'required',
        //     'no_tlp'        => 'required'
        // ]);

        $validate = $request->validated();
        $kodeAuto = "SPL-" . Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');


        $supp = new Supplier();
        $supp->id = $request->id;
        $supp->id_supplier = $kodeAuto;
        $supp->nama_supplier = $request->nama_supplier;
        $supp->alamat = $request->alamat;
        $supp->no_tlp = $request->no_tlp;
        $supp->save();
        
        // Supplier::create([
        //     'nama_supplier' => $request->nama_supplier,
        //     'alamat'        => $request->alamat,
        //     'no_tlp'        => $request->no_tlp
        // ]);

        
        alert()->success('Sukses Bro !', 'Data Berhasil Ditambahkan');

        return redirect('/datasupplier')->with('success', 'Data Berhasil di-simpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $datasupplier, $id)
    {

        $validate = $request->validated();

        Supplier::where('id', $id)->update([
            'id_supplier' => $request->id_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat'        => $request->alamat,
            'no_tlp'        => $request->no_tlp
        ]);

        alert()->success('Sukses Bro !', 'Data Berhasil Diubah');


        return redirect('/datasupplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->delete();

        alert()->warning('Terhapus Bro !', 'Data Berhasil Terhapus');


        return redirect('/datasupplier')->with('Success', 'Data Supplier Berhasil di-Hapus');
    }
}

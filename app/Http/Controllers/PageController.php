<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;  
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\KeranjangPasok;
use App\Models\PasokTransaksi;
use App\Models\PasokDetail;
use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\bon;
use App\Models\LogTransaksi;
use App\Models\LogBon;
use Carbon\Carbon;



class PageController extends Controller
{
    public function addDashboard(){
        $stok = Barang::sum('stok');
        $total_pembayaran = Transaksi::sum('uang_diterima');
        $tahunSekarang = Carbon::now()->year;
        $bulanSekarang = Carbon::now()->month;

    // $keuntunganPerBulan = Transaksi::join('detail_transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
    // ->whereYear('tgl_transaksi', $tahunSekarang)
    //     ->groupByRaw('MONTH(tgl_transaksi)')
    //     ->selectRaw('SUM(detail_transaksi.laba) as total_keuntungan, MONTH(tgl_transaksi) as bulan')
    //     ->get();

        // $keuntungan = DB::select("SELECT sum(detail_transaksi.laba), transaksi.tgl_transaksi FROM detail_transaksi  INNER JOIN transaksi ON detail_transaksi.no_transaksi = transaksi.no_transaksi WHERE month(tgl_transaksi) = ". date('m'));

        $keuntungan = Transaksi::join('detail_transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->whereYear('transaksi.tgl_transaksi', $tahunSekarang)
        ->whereMonth('transaksi.tgl_transaksi', $bulanSekarang)
        ->groupByRaw('MONTH(transaksi.tgl_transaksi), transaksi.no_transaksi, transaksi.tgl_transaksi') // Sesuaikan GROUP BY di sini
        ->selectRaw('SUM(detail_transaksi.laba) as total_keuntungan, MONTH(transaksi.tgl_transaksi) as bulan')
        ->get();

        $data_cart = DB::select("SELECT months.month, COALESCE(SUM(transaksi.total_bayar), 0) AS total_bayar
        FROM(
        SELECT 1 AS month
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
            UNION SELECT 6
            UNION SELECT 7
            UNION SELECT 8
            UNION SELECT 9
            UNION SELECT 10
            UNION SELECT 11
            UNION SELECT 12
        ) AS months
        LEFT JOIN transaksi ON months.month = MONTH(transaksi.tgl_transaksi) AND YEAR(transaksi.tgl_transaksi) = year(now())
        GROUP BY months.month");

        



        return view('admin.dashboard')->with([ 
            'title' => 'Dashboard',
            'total_stok' => $stok,
            'total_pembayaran' => $total_pembayaran,
            'keuntungan' => $keuntungan,
            'data_cart' => $data_cart,
          ]);
    }

    public function addAktivitas(){


        $log_transaksi = LogTransaksi::all();
        $log_bon = LogBon::all();

        return view('admin.aktivitas')->with([ 
            'title' => 'Aktivitas',
            'log_transaksi' => $log_transaksi,
            'log_bon' => $log_bon
          ]);
    }
  
    // CETAK ALL DATA //
    public function cetakPenjualan() 
    {
        // $penjualanAll = Transaksi::all();
        $penjualanAll =  DB::table('detail_transaksi')
                            ->join('databarang', 'databarang.id_barang', '=','detail_transaksi.id_barang')
                            ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select('transaksi.no_transaksi', 'databarang.harga_grosir', 'detail_transaksi.*')
                            ->get();

        return view('admin.laporan.cetak-penjualan')->with([
            'title' => 'Cetak Penjualan',
            'penjualan' => $penjualanAll
        ]);
    }

    public function cetakPasok() 
    {
        // $penjualanAll = Transaksi::all();
        $data_pasok = DB::table('pasok_detail')
                    ->join('databarang', 'databarang.id_barang', '=','pasok_detail.id_barang')
                    ->join('pasok_transaksi', 'pasok_transaksi.id_pasok', '=', 'pasok_detail.id_pasok')
                    ->select('pasok_transaksi.*', 'databarang.*', 'pasok_detail.*')
                    ->get();


        return view('admin.laporan.cetak-pasok')->with([
            'title' => 'Cetak Penjualan',
            'data_pasok' => $data_pasok
        ]);
    }
    
        // CETAK ALL DATA END END //

        // CETAK FILTERRED DATA //
   
    public function cariCetak(Request $request)
    {

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;
        $periode = $request->tgl_awal .' Sampai ' .  $request->tgl_akhir;
        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');


        $cariPenjualan = Transaksi::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();
        $penjualanLaba = DB::table('detail_transaksi')
                            ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select(DB::raw('sum(laba) as total_laba'))
                            ->whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                            ->get();

                            $total_laba = $penjualanLaba[0]->total_laba;

        $penjualanFilterred = DB::table('detail_transaksi')
                                ->join('databarang', 'databarang.id_barang', '=','detail_transaksi.id_barang')
                                ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                                    ->select('transaksi.*', 'databarang.harga_grosir', 'detail_transaksi.*')
                                        ->whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                                            ->get();

        return view('admin.laporan.cetak-penjualan-pertanggal')->with([
            'title' => 'Transaksi Selesai',
            'penjualan' => $cariPenjualan,
            'penjualanLaba' => $total_laba,
            'periode' => $periode,
            'date' => $date,
        ]);
    }
    public function cariCetakPasok(Request $request)
    {

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;
        $periode = $request->tgl_awal .' Sampai ' .  $request->tgl_akhir;
        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');


        $cariPasok = PasokTransaksi::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();
        $pengeluaranPasok = DB::table('pasok_detail')
                            ->join('pasok_transaksi', 'pasok_transaksi.id_pasok', '=', 'pasok_detail.id_pasok')
                            ->select(DB::raw('sum(total_bayar) as total_pengeluaran'))
                            ->whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                            ->get();

                            $total_pengeluaran = $pengeluaranPasok[0]->total_pengeluaran;

       

        return view('admin.laporan.cetak-pasok-pertanggal')->with([
            'title' => 'Cetak Pasok',
            'data_pasok' => $cariPasok,
            'pengeluaran' => $total_pengeluaran,
            'periode' => $periode,
            'date' => $date,
        ]);
    }
    public function cariCetakBon(Request $request){

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;
        $periode = $request->tgl_awal .' Sampai ' .  $request->tgl_akhir;
        $date =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y/m/d'.' - '.'H:i:s');



        $cariBon = Bon::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();
        $penjualanLaba = DB::table('detail_transaksi')
                            ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select(DB::raw('sum(laba) as total_laba'))
                            ->whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                            ->get();

                            $total_laba = $penjualanLaba[0]->total_laba;

        $penjualanFilterred = DB::table('detail_transaksi')
                                ->join('databarang', 'databarang.id_barang', '=','detail_transaksi.id_barang')
                                ->join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                                    ->select('transaksi.*', 'databarang.harga_grosir', 'detail_transaksi.*')
                                        ->whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])
                                            ->get();

        return view('admin.laporan.cetak-bon-pertanggal')->with([
            'title' => 'Bon',
            'bon' => $cariBon,
            'penjualanLaba' => $total_laba,
            'periode' => $periode,
            'date' => $date,

        ]);
    }
        // CETAK FILTERRED DATA END END //


    
    public function showDetail(Request $request, Detail $a, $no_transaksi)
    {
      

        // $detail = $a->find($no_transaksi);
        $title= 'Detail Belanja';
        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $head = DB::table('transaksi')
                            ->where('transaksi.no_transaksi', '=', $no_transaksi)
                            ->get();
        $detail = DB::table('transaksi')
                            ->join('detail_transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select('transaksi.*', 'detail_transaksi.*')
                            ->where('transaksi.no_transaksi', '=', $no_transaksi)
                            ->get();
                        
        return view('admin.non-master.detail')->with([
            'penjualanHead' => $head,
            'penjualan' => $detail,
            'title' => $title,

        ]);
    }
    public function showDetailFilterred(Request $request, Detail $a, $no_transaksi)
    {
      

        // $detail = $a->find($no_transaksi);
        $title= 'Detail Belanja';
        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $head = DB::table('transaksi')
                            ->where('transaksi.no_transaksi', '=', $no_transaksi)
                            ->get();
        $detail = DB::table('transaksi')
                            ->join('detail_transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
                            ->select('transaksi.*', 'detail_transaksi.*')
                            ->where('transaksi.no_transaksi', '=', $no_transaksi)
                            ->get();
                        
        return view('admin.non-master.detail')->with([
            'penjualanHead' => $head,
            'penjualan' => $detail,
            'title' => $title,

        ]);
    }

    public function showDetailPasok(Request $request, PasokDetail $a, $id_pasok)
    {
      

        // $detail = $a->find($no_transaksi);
        $title= 'Detail Belanja (Pasok Barang)';
        // CEK BARANG JIKA ID SUDAH TERLIST DI KERANJANG
        $head = DB::table('pasok_transaksi')
                            ->where('pasok_transaksi.id_pasok', '=', $id_pasok)
                            ->get();
                            
        $detail = DB::table('pasok_transaksi')
                            ->join('pasok_detail', 'pasok_detail.id_pasok', '=', 'pasok_transaksi.id_pasok')
                            ->select('pasok_transaksi.*', 'pasok_detail.*')
                            ->where('pasok_transaksi.id_pasok', '=', $id_pasok)
                            ->get();

        // $b = DB::table('pasok_transaksi')
        //                 ->where('pasok_transaksi.id_pasok', '=', $id_pasok)
        //                 ->select('pasok_transaksi.supplier_tujuan')->get();

        // $alamatSupplier = DB::table('data_supplier')->where('nama_supplier', '=', $b)->get();
                        
        return view('admin.non-master.detail-pasok')->with([
            'pasokHead' => $head,
            'pasok' => $detail,
            'title' => $title,
            // 'alamat' => $alamatSupplier

        ]);
    }


    public function laporan(){
        $penjualanAll = Transaksi::all();
        $data_detail = Detail::join('transaksi', 'transaksi.no_transaksi', '=', 'detail_transaksi.no_transaksi')
        ->select('transaksi.*', 'detail_transaksi.id_barang', 'detail_transaksi.nama_barang', 'detail_transaksi.harga_satuan', 'detail_transaksi.qty', 'detail_transaksi.subtotal')
        ->get();


        return view('admin.non-master.rekap')->with([
            'title' => 'Transaksi Selesai',
            'penjualan' => $penjualanAll,
            'data_detail' => $data_detail
        ]);
    }
    public function laporanPasok(Request $request){
        $pasokAll = PasokTransaksi::all();
        $data_pasok = PasokDetail::join('pasok_transaksi', 'pasok_transaksi.id_pasok', '=', 'pasok_detail.id_pasok')
        ->select('pasok_transaksi.*', 'pasok_detail.*')->get();
        $no_trans = $request->no_trans;
        $post = Detail::where('no_transaksi', '=', $no_trans)->get();


        return view('admin.non-master.rekappasok')->with([
            'title' => 'Histori Pasok',
            'pasok_all' => $pasokAll,
            'data_detail' => $data_pasok
        ]);
    }
    public function cari(Request $request)
    {

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;

        $cariPenjualan = Transaksi::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();

        return view('admin.non-master.rekapcari')->with([
            'title' => 'Transaksi Selesai',
            'penjualan' => $cariPenjualan
        ]);
    }
    public function cariPasok(Request $request)
    {

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;

        $cariPasok = PasokTransaksi::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();

        return view('admin.non-master.pasok-cari')->with([
            'title' => 'Histori Pasok',
            'pasok' => $cariPasok
        ]);
    }
    public function cariBon(Request $request){

        $tanggal_awal = $request->tgl_awal;
        $tanggal_akhir = $request->tgl_akhir;

        $cariBon = bon::whereBetween('tgl_transaksi', [$tanggal_awal, $tanggal_akhir])->get();

        return view('admin.non-master.bon-cari')->with([
            'title' => 'Bon',
            'bon' => $cariBon
        ]);
    }
    
    
    public function addPasok(){
        $data = Barang::all();
        
        $nama_jenis =  $data = Barang::join('jenisbarang', 'jenisbarang.id', '=', 'databarang.id_jenis')
        ->select('databarang.*', 'jenisbarang.nama_jenis')->get();

        $datasup = Supplier::all();
        $list = KeranjangPasok::all();

        //Hitung SubTotal SUM()
        $total_belanja = DB::table('keranjang_pasok')->sum('subtotal');
       
        $kodePasokAuto = "PN-" . Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        

        

        return view('admin.non-master.addpasok')->with([
        'title' => 'Pasok Barang',
        'data_pasok' => $data,
        'data_jenis' => $nama_jenis,
        'data_supplier' => $datasup,
        'list_keranjang' => $list,
        'total_belanja' => $total_belanja,
        'kodePasok' => $kodePasokAuto

        // 'search' => $search
        ]);
      
        }
        
    

}




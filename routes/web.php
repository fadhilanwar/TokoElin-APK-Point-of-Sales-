<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PasokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BonController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Laporan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
// PAGE CONTROLLER / Mengalirkan Halaman //

// PAGE CONTROLLER / Mengalirkan Halaman END END//
Route::get('/dashboard', [PageController::class, 'addDashboard']);
Route::get('/aktivitas', [PageController::class, 'addAktivitas']);
Route::get('/pasokbarang/add', [PageController::class, 'addPasok']);

// LOGIN ROUTE //
Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('/loginrequest', [LoginController::class, 'aksilogin']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/main-admin', function () 
{
    return view('admin.main-admin')->with([ 'title' => 'Dashboard']);
});
Route::get('/main-kasir', function () 
{
    return view('kasir.main-kasir');
});
// Route::get('/yourProfile', function () 
// {
//     return view('admin.profile');
// });
Route::get('/yourProfile', [UsersController::class, 'showProfile']);
Route::get('/yourData/{$id}', [UsersController::class, 'updateYours']);
// LOGIN ROUTE END END //
//
// User Control Route //
Route::get('/datauser', [UsersController::class, 'index']);
Route::post('/datauser/{id}', [UsersController::class, 'update']);
Route::get('/datauser/destroy/{id}', [UsersController::class, 'destroy']);
Route::resource('datauser',UsersController::class);
// User Control Route END END//
// //
// Data Jenis Control Route //
Route::get('/datajenisbarang', [JenisBarangController::class, 'index']);
Route::post('/datajenisbarang/{id}', [JenisBarangController::class, 'update']);
Route::get('/datajenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);
Route::resource('datajenisbarang',JenisBarangController::class);
// Data Jenis Control Route END END//
// //
// Data Supplier Control Route //
Route::get('/datasupplier', [SupplierController::class, 'index']);
Route::post('/datasupplier/{id}', [SupplierController::class, 'update']);
Route::get('/datasupplier/destroy/{id}', [SupplierController::class, 'destroy']);
Route::resource('datasupplier',SupplierController::class);
// Data Supplier Control Route END END//
// //
// Data Barang Control Route //
Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang/{id}', [BarangController::class, 'update']);
Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);
Route::resource('barang',BarangController::class);
// Data Barang Control Route END END//
// //
// Data Barang Control Route //
Route::get('/pasokbarang', [PasokController::class, 'index']);
Route::get('/pasokbarang/restok', [PasokController::class, 'addPasok']);
Route::post('/pasokbarang/checkout', [PasokController::class, 'checkOut']);
Route::post('/pasokbarang/{id}', [PasokController::class, 'update']);
Route::post('/pasokbarang/{id}/editQTY', [PasokController::class, 'editQTY']);
Route::get('/pasokbarang/{id}/deleteFromCart', [PasokController::class, 'DFC']);
Route::get('/pasokbarang/showPasok/{id}', [PasokController::class, 'showPasok']);
Route::get('/pasokbarang/edit/{id}', [PasokController::class, 'editQTY']);
Route::get('/pasokbarang/destroy/{id}', [PasokController::class, 'destroy']);
Route::resource('pasokbarang',PasokController::class);
// Data Barang Control Route END END//
// //
// TRANSAKSI //
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi-kasir', [TransaksiController::class, 'indexKasir']);
Route::post('/transaksi/addToCart/{id}', [TransaksiController::class, 'addToCart']);
Route::post('/transaksi/{id}/editQTY', [TransaksiController::class, 'editQTY']);
// Route::get('/transaksi/addToCart/{id}', [TransaksiController::class, 'addToCart']);
// Route::get('/transaksi/DeleteFromKeranjang/{$id}', [TransaksiController::class, 'DeleteItem']);
Route::get('/transaksi/{id}/DFCart', [TransaksiController::class, 'DFC']);
Route::resource('transaksi',TransaksiController::class);
// BON TRANSAKSI //
Route::get('/transaksi/bon', [TransaksiController::class, 'bon']);

// BON TRANSAKSI //
// TRANSAKSI //
// BON VIEW //
Route::get('/bon', [BonController::class, 'index']);
// Route::get('/bon/filter', 'BonController@filter');
Route::post('/bayar/{id}', [BonController::class, 'bayarHutang']);

// BON VIEW //
// LAPORAN //
// Route::get('/rekapPenjualan', [Laporan::class, 'laporan']);
Route::get('/rekapJual', [Laporan::class, 'rekapJual']);
Route::get('/cetakPenjualan', [Laporan::class, 'cetakLaporan']);
Route::post('/rekapPenjualan/cari', [Laporan::class, 'cari']);

Route::get('/rekappasok', [PageController::class, 'laporanPasok']);
Route::get('/cetakPasok', [PageController::class, 'cetakPasok']);
// Route::get('/cetakPasok', [PageController::class, 'cetakLaporanPasok']);
Route::post('/rekap/cari', [PageController::class, 'cari']);
Route::post('/pasok/cari', [PageController::class, 'cariPasok']);
Route::post('/bon/cari', [PageController::class, 'cariBon']);
Route::get('/bon/destroy/{id}', [BonController::class,  'deleteBon']);
Route::post('/rekap/cari-cetak', [PageController::class, 'cariCetak']);
Route::post('/pasok/cari-cetak', [PageController::class, 'cariCetakPasok']);
Route::post('/bon/cari-cetak', [PageController::class, 'cariCetakBon']);
Route::post('/rekappasok/cari', [PageController::class, 'cariPasok']);

Route::get('/transaksiSelesai', [LaporanController::class , 'transaksiSelesai']);
Route::get('/cetakAllPenjualan', [LaporanController::class, 'cetakAllPenjualan']);
Route::get('/cetakAllPasok', [LaporanController::class, 'cetakAllPasok']);
Route::get('/cetakAllBon', [LaporanController::class, 'cetakAllBon']);

Route::post('/cetakPenjualanTgl', [PageController::class, 'cetakPenjualanTgl']);
Route::post('/transaksiselesai/cari', [PageController::class, 'cari']);
// Route::get('/transaksiselesai/detail/{$no_transaksi}', [PageController::class, 'detail']);
Route::get('/showDetail/{no_transaksi}', [PageController::class, 'showDetail']);
Route::get('/rekap/showDetailFilterred/{no_transaksi}', [PageController::class, 'showDetailFilterred']);
Route::get('/showDetailPasok/{id_pasok}', [PageController::class, 'showDetailPasok']);

// LAPORAN END //
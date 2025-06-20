<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminAlatController;
use App\Http\Controllers\Admin\AdminBahanController;
use App\Http\Controllers\Admin\AdminRuanganController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Client\ClientCekController;
use App\Http\Controllers\Client\ClientPengajuanController;
use App\Http\Controllers\Client\ClientPenggunaanController;
use App\Http\Controllers\Client\ClientRiwayatController;

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

Route::get('/',  [AuthenticatedSessionController::class, 'create'])->name('beranda');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CMS ADMINITRASTOR
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('beranda');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('role', AdminRoleController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('user', AdminUserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('alat', AdminAlatController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('bahan', AdminBahanController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('category', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('ruangan', AdminRuanganController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::get('/transaksi/peminjaman', [AdminTransaksiController::class, 'transaksiPeminjaman'])->name('transaksi.peminjaman');
        Route::get('/transaksi/penggunaan', [AdminTransaksiController::class, 'transaksiPenggunaan'])->name('transaksi.penggunaan');
        Route::get('/transaksi/pengembalian', [AdminTransaksiController::class, 'transaksiPengembalian'])->name('transaksi.pengembalian');
        Route::post('/transaksi/peminjaman', [AdminTransaksiController::class, 'validasiPeminjaman'])->name('validasi.peminjaman');
        Route::post('/transaksi/penggunaan', [AdminTransaksiController::class, 'validasiPenggunaan'])->name('validasi.penggunaan');
        Route::post('/transaksi/pengembalian', [AdminTransaksiController::class, 'validasiPengembalian'])->name('validasi.pengembalian');
        Route::resource('laporan', AdminLaporanController::class)->only(['index']);
    });

    // CMS DOSEN
    Route::name('dosen.')->prefix('dosen')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('beranda');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('role', AdminRoleController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    // CMS MAHASISWA
    Route::name('mahasiswa.')->prefix('mahasiswa')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('beranda');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('check', ClientCekController::class)->only(['index']);
        Route::get('/pengajuan-peminjaman', [ClientPengajuanController::class, 'index'])->name('pengajuan-peminjaman.index');
        Route::post('/pengajuan-peminjaman', [ClientPengajuanController::class, 'store'])->name('pengajuan-peminjaman.store');
        Route::get('/generate-formulir/{id}', [ClientPengajuanController::class, 'generateFormulir'])->name('pengajuan-peminjaman.generate-formulir');
        Route::get('/penggunaan-alat', [ClientPenggunaanController::class, 'indexAlat'])->name('penggunaan-alat');
        Route::get('/penggunaan-ruangan', [ClientPenggunaanController::class, 'indexRuangan'])->name('penggunaan-ruangan');
        Route::post('/penggunaan-ruangan', [ClientPenggunaanController::class, 'storeRuangan'])->name('penggunaan-ruangan.store');
        Route::resource('history', ClientRiwayatController::class)->only(['index']);
    });
});

require __DIR__ . '/auth.php';

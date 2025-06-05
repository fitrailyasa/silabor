<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminAlatController;
use App\Http\Controllers\Admin\AdminBahanController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminRuanganController;

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

Route::get('/', function () {
    return view('welcome');
})->name('beranda');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CMS ADMINITRASTOR
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('beranda');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', AdminUserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('role', AdminRoleController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('alat', AdminAlatController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('bahan', AdminBahanController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('category', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('ruangan', AdminRuanganController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('laporan', AdminLaporanController::class)->only(['index']);
    });
});

require __DIR__ . '/auth.php';

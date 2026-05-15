<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PemberianPakanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard (hanya satu kali)
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// =============================================
// RESOURCE TERNAK
// =============================================
Route::prefix('ternak')->name('ternak.')->group(function () {
    Route::get('/', [TernakController::class, 'index'])->name('index');
    Route::get('/create', [TernakController::class, 'create'])->name('create');
    Route::post('/', [TernakController::class, 'store'])->name('store');
    Route::get('/{ternak}', [TernakController::class, 'show'])->name('show');
    Route::get('/{ternak}/edit', [TernakController::class, 'edit'])->name('edit');
    Route::put('/{ternak}', [TernakController::class, 'update'])->name('update');
    Route::delete('/{ternak}', [TernakController::class, 'destroy'])->name('destroy');
});

// =============================================
// RESOURCE KANDANG
// =============================================
Route::prefix('kandang')->name('kandang.')->group(function () {
    Route::get('/', [KandangController::class, 'index'])->name('index');
    Route::get('/create', [KandangController::class, 'create'])->name('create');
    Route::post('/', [KandangController::class, 'store'])->name('store');
    Route::get('/{kandang}', [KandangController::class, 'show'])->name('show');
    Route::get('/{kandang}/edit', [KandangController::class, 'edit'])->name('edit');
    Route::put('/{kandang}', [KandangController::class, 'update'])->name('update');
    Route::delete('/{kandang}', [KandangController::class, 'destroy'])->name('destroy');
});

// =============================================
// RESOURCE PAKAN
// =============================================
Route::prefix('pakan')->name('pakan.')->group(function () {
    Route::get('/', [PakanController::class, 'index'])->name('index');
    Route::get('/create', [PakanController::class, 'create'])->name('create');
    Route::post('/', [PakanController::class, 'store'])->name('store');
    Route::get('/{pakan}', [PakanController::class, 'show'])->name('show');
    Route::get('/{pakan}/edit', [PakanController::class, 'edit'])->name('edit');
    Route::put('/{pakan}', [PakanController::class, 'update'])->name('update');
    Route::delete('/{pakan}', [PakanController::class, 'destroy'])->name('destroy');
});

// =============================================
// RESOURCE KESEHATAN
// =============================================
Route::prefix('kesehatan')->name('kesehatan.')->group(function () {
    Route::get('/', [KesehatanController::class, 'index'])->name('index');
    Route::get('/create', [KesehatanController::class, 'create'])->name('create');
    Route::post('/', [KesehatanController::class, 'store'])->name('store');
    Route::get('/{kesehatan}', [KesehatanController::class, 'show'])->name('show');
    Route::get('/{kesehatan}/edit', [KesehatanController::class, 'edit'])->name('edit');
    Route::put('/{kesehatan}', [KesehatanController::class, 'update'])->name('update');
    Route::delete('/{kesehatan}', [KesehatanController::class, 'destroy'])->name('destroy');
});

// =============================================
// RESOURCE PEMBERIAN PAKAN
// =============================================
Route::resource('pemberian-pakan', PemberianPakanController::class);

// =============================================
// RESOURCE PENJUALAN
// =============================================
Route::resource('penjualan', PenjualanController::class);

// =============================================
// RESOURCE DETAIL PENJUALAN
// =============================================
Route::resource('detail-penjualan', DetailPenjualanController::class);
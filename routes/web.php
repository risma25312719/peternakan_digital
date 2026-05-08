<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\PakanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





// TERNAK
Route::get('/ternak',               [TernakController::class, 'index'])->name('ternak.index');
Route::get('/ternak/create',        [TernakController::class, 'create'])->name('ternak.create');
Route::post('/ternak',              [TernakController::class, 'store'])->name('ternak.store');
Route::get('/ternak/{id}',          [TernakController::class, 'show'])->name('ternak.show');
Route::get('/ternak/{id}/edit',     [TernakController::class, 'edit'])->name('ternak.edit');
Route::put('/ternak/{id}',          [TernakController::class, 'update'])->name('ternak.update');
Route::delete('/ternak/{id}',       [TernakController::class, 'destroy'])->name('ternak.destroy');

// KANDANG
Route::get('/kandang',              [KandangController::class, 'index'])->name('kandang.index');
Route::get('/kandang/create',       [KandangController::class, 'create'])->name('kandang.create');
Route::post('/kandang',             [KandangController::class, 'store'])->name('kandang.store');
Route::get('/kandang/{id}',         [KandangController::class, 'show'])->name('kandang.show');
Route::get('/kandang/{id}/edit',    [KandangController::class, 'edit'])->name('kandang.edit');
Route::put('/kandang/{id}',         [KandangController::class, 'update'])->name('kandang.update');
Route::delete('/kandang/{id}',      [KandangController::class, 'destroy'])->name('kandang.destroy');

// PAKAN
Route::get('/pakan',                [PakanController::class, 'index'])->name('pakan.index');
Route::get('/pakan/create',         [PakanController::class, 'create'])->name('pakan.create');
Route::post('/pakan',               [PakanController::class, 'store'])->name('pakan.store');
Route::get('/pakan/{id}',           [PakanController::class, 'show'])->name('pakan.show');
Route::get('/pakan/{id}/edit',      [PakanController::class, 'edit'])->name('pakan.edit');
Route::put('/pakan/{id}',           [PakanController::class, 'update'])->name('pakan.update');
Route::delete('/pakan/{id}',        [PakanController::class, 'destroy'])->name('pakan.destroy');

// KESEHATAN
Route::get('/kesehatan',            [KesehatanController::class, 'index'])->name('kesehatan.index');
Route::get('/kesehatan/create',     [KesehatanController::class, 'create'])->name('kesehatan.create');
Route::post('/kesehatan',           [KesehatanController::class, 'store'])->name('kesehatan.store');
Route::get('/kesehatan/{id}',       [KesehatanController::class, 'show'])->name('kesehatan.show');
Route::get('/kesehatan/{id}/edit',  [KesehatanController::class, 'edit'])->name('kesehatan.edit');
Route::put('/kesehatan/{id}',       [KesehatanController::class, 'update'])->name('kesehatan.update');
Route::delete('/kesehatan/{id}',    [KesehatanController::class, 'destroy'])->name('kesehatan.destroy');
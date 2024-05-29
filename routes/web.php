<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//tambah di bawah ini
route::resource('Kasir', App\Http\Controllers\KasirController::class)->middleware('auth');

route::resource('Produk', App\Http\Controllers\ProdukController::class)->middleware('auth');

route::resource('Pembeli', App\Http\Controllers\PembeliController::class)->middleware('auth');

route::resource('Transaksi', App\Http\Controllers\TransaksiController::class)->middleware('auth');


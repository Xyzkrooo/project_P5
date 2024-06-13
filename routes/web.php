<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

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

    $produk = Produk::query()->paginate(10);

    return view('welcome', compact('produk'));
});
// <h5 class="card-title">{{ $data->nama }}</h5>
//                                     <p class="card-text">Rp : {{number_format($data->harga,2) }}</p>
//                                     <p class="card-text">Stok : {!! $data->stok !!}</p>
//                                     <p class="card-text">{{ $data->deskripsi }}</p>

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//tambah di bawah ini
route::resource('Kasir', App\Http\Controllers\KasirController::class)->middleware('auth');

route::resource('Produk', App\Http\Controllers\ProdukController::class)->middleware('auth');

route::resource('Pembeli', App\Http\Controllers\PembeliController::class)->middleware('auth');

route::resource('Transaksi', App\Http\Controllers\TransaksiController::class)->middleware('auth');

Route::get('/getTotalHarga/{id}', 'TransaksiController@getTotalHarga');
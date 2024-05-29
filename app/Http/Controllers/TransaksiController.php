<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use App\Models\Pembeli;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index()
{
    $pembeli = Pembeli::all();
    $produk = Produk::all();
    $kasir = kasir::all();

    $transaksi = Transaksi::with('produk', 'pembeli', 'kasir')->latest()->paginate(5);

    return view('transaksi.index', compact('transaksi', 'pembeli', 'produk', 'kasir'));
}


    public function create()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $kasir = kasir::all();
        return view('transaksi.create', compact('pembeli', 'produk', 'kasir'));
    }

   public function store(Request $request)
    {
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pembeli' => 'required',
            'total_item' => 'required|integer|min:1',
            'id_kasir' => 'required',
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        $transaksi = new Transaksi();
        $transaksi->id_produk = $request->id_produk;
        $transaksi->id_pembeli = $request->id_pembeli;
        $transaksi->harga = $produk->harga;
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $produk->harga * $request->total_item;
        $transaksi->id_kasir = $request->id_kasir;

        $transaksi->save();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show($id)
    {
        $transaksi = transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        // $merek = merek::all();
        $transaksi = transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pembeli' => 'required',
            'harga' => 'required',
            'total_item' => 'required|min:1',
            'total_harga' => 'required|min:1',
            'id_kasir' => 'required',
        ]);

        $transaksi = transaksi::findOrFail($id);
        $transaksi->id_produk = $request->id_produk;
        $transaksi->id_pembeli = $request->id_pembeli;
        $transaksi->harga = $request->harga;
        $transaksi->bayar = $request->bayar;
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $request->harga * $request->total_item;
        $transaksi->id_kasir = $request->id_kasir;

        // upload image

        $transaksi->save();
        return redirect()->route('transaksi.index');

    }

    public function destroy($id)
    {
        $transaksi = transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('Transaksi.index');

    }
}

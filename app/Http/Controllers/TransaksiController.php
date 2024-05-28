<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksi = transaksi::latest()->paginate(5);
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        // $transaksi = merek::all();
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'id_produk' => 'required',
            'id_transaksi' => 'required',
            'total_bayar' => 'required|min:3',
            'total_item' => 'required|min:1',
            'total_harga' => 'required|min:1',
            'id_kasir' => 'required',
        ]);

        $transaksi = new transaksi();
        $transaksi->id_produk = $request->id_produk;
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->id_kasir = $request->id_kasir;
        // upload image

        $transaksi->save();
        return redirect()->route('transaksi.index');
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
            'id_transaksi' => 'required',
            'total_bayar' => 'required|min:3',
            'total_item' => 'required|min:1',
            'total_harga' => 'required|min:1',
            'id_kasir' => 'required',
        ]);

        $transaksi = transaksi::findOrFail($id);
        $transaksi->id_produk = $request->id_produk;
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->total_bayar = $request->total_bayar;
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->id_kasir = $request->id_kasir;

        // upload image

        $transaksi->save();
        return redirect()->route('transaksi.index');

    }

    public function destroy($id)
    {
        $transaksi = transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index');

    }
}

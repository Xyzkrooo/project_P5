<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\support\facades\Storage;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::latest()->paginate(5);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required|min:5',
            'harga' => 'required|min:2',
            'stok' => 'required|min:1',
            'deskripsi' => 'required|min:10',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',

        ]);

        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/produks', $image->hashName());
        $produk->image = $image->hashName();
        $produk->save();
        return redirect()->route('Produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|min:5',
            'harga' => 'required|min:2',
            'stok' => 'required|min:1',
            'deskripsi' => 'required|min:10',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->nama = $request->nama;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->deskripsi = $request->deskripsi;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/produks', $image->hashName());
        //delete old image
        Storage::delete('public/produks/' . $produk->image);

        $produk->image = $image->hashName();
        $produk->save();
        return redirect()->route('Produk.index');

    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        Storage::delete('public/produks/' . $produk->image);
        $produk->delete();
        return redirect()->route('Produk.index');

    }
}

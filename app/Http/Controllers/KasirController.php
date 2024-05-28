<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use Illuminate\Http\Request;
use Storage;

class kasirController extends Controller
{

    public function index()
    {
        $kasir = kasir::latest()->paginate(5);
        return view('Kasir.index', compact('kasir'));
    }

    public function create()
    {
        // $kasir = merek::all();
        return view('Kasir.create');
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama_kasir' => 'required|min:3',
            'jk' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $kasir = new kasir();
        $kasir->nama_kasir = $request->nama_kasir;
        $kasir->jk = $request->jk;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/kasirs', $image->hashName());
        $kasir->image = $image->hashName();

        $kasir->save();
        return redirect()->route('Kasir.index');
    }

    public function show($id)
    {
        $kasir = kasir::findOrFail($id);
        return view('Kasir.show', compact('kasir'));
    }

    public function edit($id)
    {
        // $merek = merek::all();
        $kasir = kasir::findOrFail($id);
        return view('Kasir.edit', compact('kasir'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'nama_kasir' => 'required|min:3',
            'jk' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $kasir = kasir::findOrFail($id);
        $kasir->nama_kasir = $request->nama_kasir;
        $kasir->jk = $request->jk;
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/kasirs', $image->hashName());
        $kasir->image = $image->hashName();

        $kasir->save();
        return redirect()->route('Kasir.index');

    }

    public function destroy($id)
    {
        $kasir = kasir::findOrFail($id);
        Storage::delete('public/kasirs/' . $kasir->image);
        $kasir->delete();
        return redirect()->route('Kasir.index');

    }
}

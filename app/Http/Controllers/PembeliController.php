<?php

namespace App\Http\Controllers;

use App\Models\pembeli;
use Illuminate\Http\Request;


class pembeliController extends Controller
{

    public function index()
    {
        $pembeli = pembeli::latest()->paginate(5);
        return view('Pembeli.index', compact('pembeli'));
    }

    public function create()
    {
        // $pembeli = merek::all();
        return view('Pembeli.create');
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama_pembeli' => 'required|min:3',
            'jk' => 'required',

        ]);

        $pembeli = new pembeli();
        $pembeli->nama_pembeli = $request->nama_pembeli;
        $pembeli->jk = $request->jk;
        // upload image

        $pembeli->save();
        return redirect()->route('Pembeli.index');
    }

    public function show($id)
    {
        $pembeli = pembeli::findOrFail($id);
        return view('Pembeli.show', compact('pembeli'));
    }

    public function edit($id)
    {
        // $merek = merek::all();
        $pembeli = pembeli::findOrFail($id);
        return view('Pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'nama_pembeli' => 'required|min:3',
            'jk' => 'required',
        ]);

        $pembeli = pembeli::findOrFail($id);
        $pembeli->nama_pembeli = $request->nama_pembeli;
        $pembeli->jk = $request->jk;
        // upload image

        $pembeli->save();
        return redirect()->route('Pembeli.index');

    }

    public function destroy($id)
    {
        $pembeli = pembeli::findOrFail($id);
        $pembeli->delete();
        return redirect()->route('Pembeli.index');

    }
}

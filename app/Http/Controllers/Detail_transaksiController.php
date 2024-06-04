<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use App\Models\Pembeli;
use App\Models\Produk;
use App\Models\Detail_transaksi;
use Illuminate\Http\Request;

class Detail_transaksiController extends Controller
{

    public function index()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $kasir = Kasir::all();

        $detail_transaksi = Detail_transaksi::with('produk', 'pembeli', 'kasir')->latest()->paginate(5);

        // Calculate total_bayar for each transaction
        foreach ($detail_transaksi as $item) {
            $total_bayar = $item->produk ? $item->produk->harga * $item->total_item : 0;
            $item->total_bayar = $total_bayar;
        }

        return view('transaksi.create', compact('detail_transaksi', 'pembeli', 'produk', 'kasir'));
    }

    public function create()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $kasir = kasir::all();
        $detail_transaksi = Detail_transaksi::all();
        return view('transaksi.create', compact('pembeli', 'produk', 'kasir','detail_transaksi'));
    }

    public function struk(Request $request)
    {
        $this->validate($request, [
            'total_bayar' => 'required|numeric',
        ]);

        $detail_transaksi = new Detail_transaksi();
        $detail_transaksi->total_bayar = $request->total_bayar;

        $detail_transaksi->save();
        return redirect()->route('transaksi.struk');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pembeli' => 'required',
            'total_item' => 'required|integer|min:1',
            'id_kasir' => 'required',
        ]);

        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($request->id_produk);

        // Pastikan produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Periksa apakah stok cukup
        if ($produk->stok < $request->total_item) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        // Kurangi stok produk
        $produk->stok -= $request->total_item;
        $produk->save();

        // Buat instance detail_transaksi
        $detail_transaksi = new Detail_transaksi();
        $detail_transaksi->id_produk = $request->id_produk;
        $detail_transaksi->id_pembeli = $request->id_pembeli;
        $detail_transaksi->harga = $produk->harga;
        $detail_transaksi->total_item = $request->total_item;
        $detail_transaksi->total_harga = $produk->harga * $request->total_item;
        $detail_transaksi->id_kasir = $request->id_kasir;

        // Simpan detail_transaksi
        $detail_transaksi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('Transaksi.create')->with('success', 'detail_transaksi berhasil disimpan.');
    }


    public function show($id)
    {
        $detail_transaksi = Detail_transaksi::findOrFail($id);
        return view('detail_transaksi.show', compact('detail_transaksi'));
    }

    public function edit($id)
    {
        $detail_transaksi = Detail_transaksi::findOrFail($id);
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $kasir = Kasir::all();
        return view('detail_transaksi.edit', compact('detail_transaksi', 'pembeli', 'produk', 'kasir'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_produk' => 'required',
            'id_pembeli' => 'required',
            'total_item' => 'required|integer|min:1',
            'id_kasir' => 'required',
        ]);
    
        // Cari detail_transaksi berdasarkan ID
        $detail_transaksi = Detail_transaksi::findOrFail($id);
    
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($request->id_produk);
    
        // Pastikan produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    
        // Update atribut detail_transaksi
        $detail_transaksi->id_produk = $request->id_produk;
        $detail_transaksi->id_pembeli = $request->id_pembeli;
        $detail_transaksi->harga = $produk->harga;
        $detail_transaksi->total_item = $request->total_item;
        $detail_transaksi->total_harga = $produk->harga * $request->total_item;
        $detail_transaksi->id_kasir = $request->id_kasir;
    
        // Simpan perubahan detail_transaksi
        $detail_transaksi->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('detail_transaksi.index')->with('success', 'detail_transaksi berhasil diubah.');
    }
    



    public function destroy($id)
    {
        $detail_transaksi = Detail_transaksi::findOrFail($id);

        // Temukan produk yang terkait dengan detail_transaksi yang dihapus
        $produk = Produk::findOrFail($detail_transaksi->id_produk);

        // Tambahkan jumlah stok yang dikurangi sebelumnya
        $produk->stok += $detail_transaksi->total_item;
        $produk->save();

        // Hapus detail_transaksi
        $detail_transaksi->delete();

        return redirect()->route('Transaksi.create')->with('success', 'Transaksi berhasil dihapus dan stok produk dikembalikan.');

    }
}

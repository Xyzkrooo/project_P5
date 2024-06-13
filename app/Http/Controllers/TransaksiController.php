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
        $produk = Produk::all();
        $kasir = Kasir::all();

        $transaksi = Transaksi::with('produk', 'kasir')->latest()->paginate(5);

        // Calculate total_bayar for each transaction
        foreach ($transaksi as $item) {
            $total_bayar = $item->produk ? $item->produk->harga * $item->total_item : 0;
            $item->total_bayar = $total_bayar;
        }
        return view('transaksi.index', compact('transaksi', 'produk', 'kasir'));
    }

    public function create()
    {
        $produk = Produk::all();
        $kasir = kasir::all();
        $transaksi = Transaksi::all();
        $transaksi = Transaksi::with('produk', 'kasir')->latest()->paginate(4);

        return view('transaksi.create', compact('produk', 'kasir', 'transaksi'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_produk' => 'required',
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

        //total harga
        $total_harga = $produk->harga * $request->total_item;

        // Buat instance transaksi
        $transaksi = new Transaksi();
        $transaksi->id_produk = $request->id_produk;
        $transaksi->harga = $produk->harga;
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $total_harga;
        $transaksi->id_kasir = $request->id_kasir;

        // Simpan transaksi
        $transaksi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('Transaksi.create')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function getTotalHarga($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return $transaksi->total_harga;
    }

    

    protected function addTransaksi()
    { {
            $produk = Produk::first(); // Assuming you want to get the first product
            $kasir = Kasir::first(); // Assuming you want to get the first cashier

            if (!$produk || !$kasir) {
                return redirect()->back()->with('error', 'Produk atau kasir tidak ditemukan.');
            }

            $data = [
                'id_produk' => $produk->id, // Accessing the id property of the product
                'id_kasir' => $kasir->id, // Accessing the id property of the cashier
                'harga' => 0

            ];

            Transaksi::create($data);

            return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
        }
    }


    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $produk = Produk::all();
        $kasir = Kasir::all();
        return view('transaksi.edit', compact('transaksi', 'produk', 'kasir'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_produk' => 'required',
            'total_item' => 'required|integer|min:1',
            'id_kasir' => 'required',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($request->id_produk);

        // Pastikan produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }


        // Update atribut transaksi
        $transaksi->id_produk = $request->id_produk;
        $transaksi->harga = $produk->harga;
        $transaksi->total_item = $request->total_item;
        $transaksi->id_kasir = $request->id_kasir;

        // Simpan perubahan transaksi
        $transaksi->save();

        // Redirect dengan pesan sukses
        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil diubah.');
    }




    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Temukan produk yang terkait dengan transaksi yang dihapus
        $produk = Produk::findOrFail($transaksi->id_produk);

        // Tambahkan jumlah stok yang dikurangi sebelumnya
        $produk->stok += $transaksi->total_item;
        $produk->save();

        // Hapus transaksi
        $transaksi->delete();

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil dihapus dan stok produk dikembalikan.');
    }
}

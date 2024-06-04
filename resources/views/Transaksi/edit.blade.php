@extends('layouts.sidebar')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('Dashboard') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Transaksi.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('Transaksi.update', $transaksi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control">
                                    <option disabled selected ="">nama produk</option>
                                    @forelse ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_pembeli" class="form-label">Pembeli</label>
                                <select name="id_pembeli" id="id_pembeli" class="form-control">
                                    <option disabled selected ="">nama pembeli</option>
                                    @forelse ($pembeli as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_pembeli }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="total_item" class="form-label">Total Item</label>
                                <input type="number" name="total_item" id="total_item" class="form-control" min="1"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="id_kasir" class="form-label">Kasir</label>
                                <select name="id_kasir" id="id_kasir" class="form-control">
                                    <option disabled selected ="">kasir</option>
                                    @forelse ($kasir as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kasir }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-sm btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

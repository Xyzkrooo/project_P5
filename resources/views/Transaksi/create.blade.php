@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Transaksi</div>

                <div class="card-body">
                    <form action="{{ route('Transaksi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="id_produk" class="form-label">Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control">
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_pembeli" class="form-label">Pembeli</label>
                            <select name="id_pembeli" id="id_pembeli" class="form-control">
                                @foreach ($pembeli as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_pembeli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="total_item" class="form-label">Total Item</label>
                            <input type="number" name="total_item" id="total_item" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_kasir" class="form-label">Kasir</label>
                            <select name="id_kasir" id="id_kasir" class="form-control">
                                @foreach ($kasir as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kasir }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

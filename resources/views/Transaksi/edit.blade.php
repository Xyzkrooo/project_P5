@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('Dashboard') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('barang.update', $barang->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Nama Barang" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" value="{{ old('harga') }}" placeholder="Harga" required>
                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    name="stok" value="{{ old('stok') }}" placeholder="Stok" required>
                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Merek</label>
                                <select name="id_merek" class="form-select">
                                    @forelse ($merek as $data)
                                        <option value="{{ $data->id }}" @error('id_merek') is-invalid @enderror>
                                            {{ $data->nama_merek }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                                @error('id_merek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

<style>
    a.text-decoration-none {
        color: black; /* Mengubah warna teks tautan menjadi hitam */
    }
    .card-img-container {
        display: flex;
        justify-content: center; /* Memusatkan secara horizontal */
        align-items: center; /* Memusatkan secara vertikal */
        height: 200px; /* Tinggi gambar */
    }
</style>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('produk') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Produk.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="container mt-3">
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        @forelse ($produk as $data)
                            <div class="card mb-3 text-decoration-none" style="width: 21rem;">
                                <a href="{{ route('Produk.show', $data->id) }}" class="text-decoration-none">
                                    <div class="card-img-container">
                                        <img src="{{ asset('/storage/produks/' . $data->image) }}" class="card-img-top"
                                            alt="..." style="width: 50%">
                                    </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->nama }}</h5>
                                    <p class="card-text">Rp : {!! $data->harga !!}</p>
                                    <p class="card-text">Stok : {!! $data->stok !!}</p>
                                    <p class="card-text">{{ $data->deskripsi }}</p>
                                </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Data belum tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {!! $produk->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection

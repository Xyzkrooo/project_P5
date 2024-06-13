<style>
    a.text-decoration-none {
        color: black;
        /* Mengubah warna teks tautan menjadi hitam */
    }

    .card1 {
        margin-top: 1rem;
        width: 260px;
        height: 434px;
        padding: .8em;
        background: #f5f5f5;
        position: relative;
        overflow: visible;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .card1-img {
        background-color: #ffcaa6;
        height: 55%;
        width: 100%;
        border-radius: .5rem;
        transition: .3s ease;
    }

    .card1-info {
        padding-top: 10%;
    }

    svg {
        width: 20px;
        height: 20px;
    }

    .card1-footer {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 10px;
        border-top: 1px solid #ddd;
    }

    /*Text*/
    .text-title {
        font-weight: 900;
        font-size: 1.2em;
        line-height: 1.5;
    }

    .text-body {
        font-size: .9em;
        padding-bottom: 10px;
    }

    /*Button*/
    .card1-button {
        border: 1px solid #252525;
        display: flex;
        padding: .3em;
        cursor: pointer;
        border-radius: 50px;
        transition: .3s ease-in-out;
    }

    /*Hover*/
    .card1-img:hover {
        transform: translateY(-25%);
        box-shadow: rgba(226, 196, 63, 0.25) 0px 13px 47px -5px, rgba(180, 71, 71, 0.3) 0px 8px 16px -8px;
    }

    .card1-button:hover {
        border: 1px solid #ffcaa6;
        background-color: #ffcaa6;
    }
</style>

@extends('layouts.sidebar')

@section('content')
    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="container mt-5 ">
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
                <div class="container mt-4">
                    <div class="d-flex flex-row flex-wrap">
                        @forelse ($produk as $data)
                            <div class="col-md-4">
                                <a href="{{ route('Produk.show', $data->id) }}" class="text-decoration-none">
                                    <div class="card1">
                                        <img class="card1-img" src="{{ asset('/storage/produks/' . $data->image) }}">
                                        <div class="card1-info">
                                            <p class="text-title">{{ $data->nama }}</p>
                                            <p class="text-body">{{ $data->deskripsi }}</p>
                                        </div>
                                
                                        <div class="card1-footer">                                                
                                            <span class="text-title">Rp : {{ number_format($data->harga, 2) }}</span>
                                            <span class="text-body">Stok : {{ $data->stok }}</span>
                                        </div>
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
                

                {{-- {!! $produk->withQueryString()->links('pagination::bootstrap-4') !!} --}}
            </div>
        </div>
    </div>
@endsection

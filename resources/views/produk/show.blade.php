@extends('layouts.sidebar')

@section('content')
<!-- styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mx-auto" style="width: 90%">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('produk') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Produk.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <img src="{{ asset('storage/produks/' . $produk->image) }}" class="mx-auto mb-3 d-block"
                                style="height: 200px; width: auto; justify-content:center">
                            <div class="col-md-8"> <!-- Column for product details -->
                                <h4>{{ $produk->nama }}</h4>
                                <p class="tmt-3">
                                    Harga : Rp.{{ number_format($produk->harga, 2) }}
                                </p>
                                <p class="tmt-3">
                                    Stok : {{ $produk->stok }}
                                </p>
                                <p class="tmt-3">
                                    {!! $produk->deskripsi !!}
                                </p>
                                <div class="col-md-4 text-center"> <!-- Column for form action -->
                                    <form action="{{ route('Produk.destroy', $produk->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('Produk.edit', $produk->id) }}"
                                                class="btn btn-sm btn-outline-success" style="margin-right: 5px">Edit</a>
                                             <button type="submit" {{--onclick="return confirm('Are You Sure ?');"--}}
                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

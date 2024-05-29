@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Produk') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
    
                    <h4>{{ $barang->nama_barang }}</h4>
                    <p class="tmt-3 mt-4">
                        Harga : Rp.{{ number_format($barang->harga, 2) }}
                    </p>
                     <p class="tmt-3">
                        Stok : {{ number_format($barang->stok,3) }}
                    </p>
                    <p class="tmt-3 ">
                        ID : {{ $barang->id_merek }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

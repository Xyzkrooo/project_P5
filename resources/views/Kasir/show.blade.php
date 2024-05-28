@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top: 10%">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('Profile produk') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Produk.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/produks/' . $produk->image) }}" class="img-fluid rounded-start" >
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4>{{ $produk->nama_produk }}</h4>
                                    <p class="tmt-3">
                                        Jenis Kelamin : {{ $produk->jk }}
                                    </p>
                                    <p class="card-text"><small class="text-muted">Last Update {{$produk->updated_at}}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                            <a href="{{ route('Pembeli.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('Pembeli.update', $pembeli->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                             <div class="mb-3">
                                <label class="form-label">Nama Pembeli</label>
                                <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                                    name="nama_pembeli" value="{{ old('nama_pembeli') }}" placeholder="Nama Pembeli" required>
                                @error('nama_pembeli')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-mb-1 md-2">
                                <label for="jenis_kelamin"
                                    class="col col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-12 mb-3">
                                    <select id="jk" class="form-select " name="jk" required autofocus>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>

                                    @error('jk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
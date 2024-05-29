@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mx-auto" style="width: 80%">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('transaksi') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Transaksi.create') }}" class="btn btn-sm btn-outline-primary">Tambah</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Pembeli</th>
                                        <th>Harga</th>
                                        <th>Total Item</th>
                                        <th>Kasir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($transaksi as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                @if ($data->produk)
                                                    {{ $data->produk->nama }}
                                                @else
                                                    produk tidak ditemukan
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->pembeli)
                                                    {{ $data->pembeli->nama_pembeli }}
                                                @else
                                                    pembeli tidak ditemukan
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->produk)
                                                    {{ $data->produk->harga }}
                                                @else
                                                    harga tidak ditemukan
                                                @endif
                                            </td>
                                            <td>{{ $data->total_item }}</td>
                                            <td>
                                                @if ($data->kasir)
                                                    {{ $data->kasir->nama_kasir }}
                                                @else
                                                    produk tidak ditemukan
                                                @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('Transaksi.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="{{ route('Pembeli.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-dark">Show</a> | --}}
                                                    <a href="{{ route('Transaksi.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit</a> |
                                                    <button type="submit" onclick="return confirm('Are You Sure ?');"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Data belum tersedia.
                                            </td>
                                        </tr>


                                </tbody>
                            </table>
                            {!! $transaksi->links() !!}
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{-- <h2>Total Harga <span class="d-flex justify-content-between">{{ $data->total_harga }}</span></h2> --}}
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

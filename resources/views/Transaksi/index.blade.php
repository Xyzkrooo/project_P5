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
                                    @php $no = 1; $totalHarga = 0; @endphp
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
                                        @if ($data->produk)
                                            @php $totalHarga += $data->produk->harga * $data->total_item; @endphp
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                Data belum tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {!! $transaksi->links() !!}
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <h4>Total Harga: {{ number_format($totalHarga, 2) }}</h4>
                        <a href="{{ route('Transaksi.struk') }}" class="btn btn-sm btn-primary">Bayar</a>
                        {{-- <form action="{{ route('transaksi.store') }}" method="POST" class="" style="width: 30%">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Input Bayar" name="total_bayar">
                                <button class="btn btn-primary" type="submit">Bayar</button>
                            </div>
                        </form> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

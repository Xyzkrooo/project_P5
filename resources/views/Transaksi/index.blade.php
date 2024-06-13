@extends('layouts.sidebar')

@section('content')
<!-- styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">

    <div class="container mt-5">
        <div class="row justify-content-start">
            <div class="col-md-12">
                <div class="card mx-auto" style="width: 80%">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('transaksi') }}
                        </div>
                        <div class="float-end mt">
                            <a href="{{ route('Transaksi.create') }}" class="btn btn-sm btn-outline-primary"><i class='bx bx-plus' ></i></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>total</th>
                                        <th>Tanggal</th>
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
                                                @if ($data->produk)
                                                    Rp. {{ number_format($data->produk->harga, 2) }} 
                                                @else
                                                    harga tidak ditemukan
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                
                                                 {{ $data->total_item }} 

                                    
                                        </td>
                                            <td>
                                                
                                                    Rp. {{ number_format($data->total_harga, 2) }} 

                                        
                                            </td>
                                            <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                                            {{-- <td>
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
                                            </td> --}}

                                            <td>
                                                <form action="{{ route('Transaksi.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="{{ route('Pembeli.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-dark">Show</a> | --}}
                                                    <a href="{{ route('Transaksi.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success"><i class='bx bx-edit'></i></a> |
                                                    <button type="submit" onclick="return confirm('Are You Sure ?');"
                                                        class="btn btn-sm btn-outline-danger"><i class='bx bx-trash' ></i></button>
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
                                <tfoot>
                                    <h5>Pemasukan: {{ number_format($totalHarga, 2) }}</h5>
                                </tfoot>
                            </table>
                            
                            {!! $transaksi->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                        
                        {{-- <a href="{{ route('Transaksi.struk') }}" class="btn btn-sm btn-primary">Bayar</a> --}}
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
@endsection

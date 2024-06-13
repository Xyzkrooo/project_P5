@extends('layouts.sidebar')

@section('content')
    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <div class="container mt-5">
        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tambah Transaksi
                        <div class="float-end">
                            <a href="{{ route('Transaksi.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('Transaksi.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control">
                                    <option disabled selected ="">nama produk</option>
                                    @forelse ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="total_item" class="form-label">Total Item</label>
                                <input type="number" name="total_item" id="total_item" class="form-control" min="1"
                                    required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="total_item" class="form-label">Total Bayar</label>
                                <input type="text" class="form-control" placeholder="Input Bayar" name="total_bayar">
                            </div> --}}
                            <div class="mb-3">
                                <label for="id_kasir" class="form-label">Kasir</label>
                                <select name="id_kasir" id="id_kasir" class="form-control">
                                    <option disabled selected ="">kasir</option>
                                    @forelse ($kasir as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kasir }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </form>
                    </div>
                </div>
                {{-- <div class="row-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="total_harga" class="form-label">Produk</label>
                                <select name="total_harga" id="total_harga" class="form-control">
                                    <option disabled selected ="">nama produk</option>
                                    @forelse ($transaksi as $item)
                                        <option value="{{ $item->id }}">{{ $item->id }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="totalBayarInput" class="form-label">Total Bayar:</label>
                                <input type="text" id="totalBayarInput" class="form-control" placeholder="Total Bayar">
                            </div>
                            <div class="mb-3">
                                <label for="kembalianOutput" class="form-label">Kembalian:</label>
                                <input type="text" id="kembalianOutput" class="form-control" placeholder="Kembalian"
                                    disabled>
                            </div>
                            <button id="hitungKembalian" class="btn btn-primary">Hitung Kembalian</button>
                        </div>
                    </div>
                </div> --}}




                {{-- <div class="col-md-6">
                <div class="row-md-6 mt-1">
                    <div class="card">
                        <div class="card-header align">
                            @php $totalHarga = 0; @endphp <!-- Inisialisasi total harga  -->
                            @forelse ($transaksi as $data)
                                @if ($data->produk)
                                    @php $totalHarga += $data->produk->harga * $data->total_item; @endphp
                                @endif
                            @empty
                            @endforelse
                            <h5>Total Harga: Rp. {{ number_format($totalHarga, 2) }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="totalBayarInput" class="form-label">Total Bayar:</label>
                                <input type="text" id="totalBayarInput" class="form-control" placeholder="Total Bayar">
                            </div>
                            <div class="mb-3">
                                <label for="kembalianOutput" class="form-label">Kembalian:</label>
                                <input type="text" id="kembalianOutput" class="form-control" placeholder="Kembalian" disabled>
                            </div>
                            <button id="hitungKembalian" class="btn btn-primary">Hitung Kembalian</button>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-6">
                <div class="card mx-auto" style="width: 100%">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Total Item</th>
                                        <th class="text-center">kasir</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $totalHarga = 0;
                                    @endphp
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
                                                    {{ number_format($data->produk->harga, 2) }}
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
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                            </td>
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
                            {!! $transaksi->links('pagination::bootstrap-5') !!}
                            {{-- <a href="" class="btn btn-success text-white"><i class='bx bx-check'> Selesai</i></a>
                            <a href="" class="btn btn-info text-white"><i class='bx bxs-file-blank'> Pending</i></a> --}}
                        </div>
                    </div>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($transaksi as $item)

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <h6>{{ $no++ }} | Total Harga: {{ number_format($item->total_harga, 2) }}</h6>
                        </div>
                    @empty
                    @endforelse
                </div>


            </div>
        </div>

        @forelse ($transaksi as $item)
            <script>
                document.getElementById('hitungKembalian').addEventListener('click', function() {
                    var totalBayar = parseFloat(document.getElementById('totalBayarInput').value);
                    var kembalian = totalBayar - {{ $item->tota_harga }};

                    document.getElementById('kembalianOutput').value = kembalian.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                });
            </script>
        @empty
        @endforelse


    </div>
    </div>
    </div>
@endsection

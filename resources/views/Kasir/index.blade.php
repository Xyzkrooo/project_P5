@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('Kasir') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Kasir.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama </th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($kasir as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_kasir }}</td>
                                            <td>{{ $data->jk }}</td>

                                            <td>
                                                <form action="{{ route('Kasir.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('Kasir.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-dark">Show</a> |
                                                    <a href="{{ route('Kasir.edit', $data->id) }}"
                                                        class="btn btn-sm btn-outline-success">Edit</a> |
                                                    <button type="submit" onclick="return confirm('Are You Sure ?');"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Data belum tersedia.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            {!! $kasir->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

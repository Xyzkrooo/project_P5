@extends('layouts.sidebar')

@section('content')
<!-- styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="container">

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mx-auto" style="width: 70%">
                    <div class="card-header">
                        <div class="float-start">
                            {{ __('pembeli') }}
                        </div>
                        <div class="float-end">
                            <a href="{{ route('Pembeli.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
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
                                    @forelse ($pembeli as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_pembeli }}</td>
                                            <td>{{ $data->jk }}</td>

                                            <td>
                                                <form action="{{ route('Pembeli.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="{{ route('Pembeli.show', $data->id) }}"
                                                        class="btn btn-sm btn-outline-dark">Show</a> | --}}
                                                    <a href="{{ route('Pembeli.edit', $data->id) }}"
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
                            {!! $pembeli->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

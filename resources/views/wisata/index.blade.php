@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Data Wisata</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('wisata.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Wisata</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <a href="{{ route('wisata.create') }}" class="btn btn-primary mb-3">Tambah Wisata</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Wisata</th>
                    <th>Nama Wisata</th>
                    <th>Deskripsi</th>
                    <th>Alamat</th>
                    <th>Kategori</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $wisata)
                <tr>
                    <td>{{ $wisata->id_wisata }}</td>
                    <td>{{ $wisata->nama_wisata }}</td>
                    <td>{{ $wisata->deskripsi }}</td>
                    <td>{{ $wisata->alamat }}</td>
                    <td>{{ $wisata->kategori->nama_kategori ?? 'N/A' }}</td>
                    <td>{{ $wisata->lat }}</td>
                    <td>{{ $wisata->long }}</td>
                    <td>
                        <a href="{{ route('wisata.edit', $wisata->id_wisata) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('wisata.destroy', $wisata->id_wisata) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus wisata ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

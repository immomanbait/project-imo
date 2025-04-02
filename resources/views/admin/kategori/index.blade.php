@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Data Kategori</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $kategori)
                <tr>
                    <td>{{ $kategori->id_kategori }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori->id_kategori) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id_kategori) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

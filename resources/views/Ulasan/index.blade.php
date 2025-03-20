@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Data Ulasan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('ulasan.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Ulasan</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <a href="{{ route('ulasan.create') }}" class="btn btn-primary mb-3">Tambah Ulasan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Ulasan</th>
                    <th>Nama Wisata</th>
                    <th>Komentar</th>
                    <th>Rating</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $ulasan)
                <tr>
                    <td>{{ $ulasan->id_ulasan }}</td>
                    <td>{{ $ulasan->wisata->nama_wisata ?? 'N/A' }}</td>
                    <td>{{ $ulasan->komentar }}</td>
                    <td>{{ $ulasan->rating }}</td>
                    <td>{{ $ulasan->tanggal }}</td>
                    <td>
                        <a href="{{ route('ulasan.edit', $ulasan->id_ulasan) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('ulasan.destroy', $ulasan->id_ulasan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus ulasan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

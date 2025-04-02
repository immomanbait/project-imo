@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tambah Kategori</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Kategori</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

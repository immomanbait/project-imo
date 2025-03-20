@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tambah Wisata</h4>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <form action="{{ route('wisata.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Wisata</label>
                <input type="number" name="id_wisata" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Wisata</label>
                <input type="text" name="nama_wisata" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input type="number" name="lat" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input type="number" name="long" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection

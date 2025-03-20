@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Edit Wisata</h4>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <form action="{{ route('wisata.update', $wisata->id_wisata) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Wisata</label>
                <input type="text" name="nama_wisata" value="{{ $wisata->nama_wisata }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required>{{ $wisata->deskripsi }}</textarea>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $wisata->alamat }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ $kat->id_kategori == $wisata->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input type="number" name="lat" value="{{ $wisata->lat }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input type="number" name="long" value="{{ $wisata->long }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection

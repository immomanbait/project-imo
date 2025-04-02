@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="container">
    <h2>Detail Wisata</h2>
    
    <h2>Nama Tempat Wisata: {{ $wisata->nama_wisata }}</h2>
    <p><strong>Alamat:</strong> {{ $wisata->alamat }}</p>
    <p><strong>Deskripsi:</strong> {{ $wisata->deskripsi }}</p>
    <p><strong>Koordinat:</strong> {{ $wisata->lat }}, {{ $wisata->long }}</p>

    <h4>Gambar:</h4>
    @if($wisata->gambar_a)
        <img src="{{ asset('images/wisata/'.$wisata->gambar_a) }}" width="300">
    @endif
    @if($wisata->gambar_b)
        <img src="{{ asset('images/wisata/'.$wisata->gambar_b) }}" width="300">
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection

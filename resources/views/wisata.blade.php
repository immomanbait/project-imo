@extends('layouts.adminLayout.admin_desing')

@section('content')
<table>
    <tr>
        <th>ID</th>
        <th>ID Kategori</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Alamat</th>


    </tr>
    @foreach($data as $item)
    <tr>
        <td>{{ $item->id_wisata }}</td>
        <td>{{ $item->id_kategori }}</td>
        <td>{{ $item->nama_wisata }}</td>
        <td>{{ $item->deskripsi}}</td>
        <td>{{ $item->alamat }}</td>
        



    </tr>
    @endforeach
</table>
@endsection
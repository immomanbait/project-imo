@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Edit Ulasan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('ulasan.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Ulasan</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <form action="{{ route('ulasan.update', $ulasan->id_ulasan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_wisata">Nama Wisata</label>
                <select name="id_wisata" class="form-control" required>
                    @foreach($wisata as $w)
                    <option value="{{ $w->id_wisata }}" {{ $ulasan->id_wisata == $w->id_wisata ? 'selected' : '' }}>
                        {{ $w->nama_wisata }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="komentar">Komentar</label>
                <textarea name="komentar" class="form-control" rows="3" required>{{ $ulasan->komentar }}</textarea>
            </div>

            <div class="form-group">
                <label for="rating">Rating (0 - 5)</label>
                <input type="number" name="rating" class="form-control" step="0.1" min="0" max="5" value="{{ $ulasan->rating }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="datetime-local" name="tanggal" class="form-control" value="{{ \Carbon\Carbon::parse($ulasan->tanggal)->format('Y-m-d\TH:i') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('ulasan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

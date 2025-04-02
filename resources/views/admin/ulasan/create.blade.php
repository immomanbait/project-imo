@extends('layouts.userLayout.user_desing')

@section('content')
<div class="container mt-4">
    <h4>Tambah Ulasan</h4>
    
    @include('layouts.userLayout.user_messages')

    <form action="{{ route('ulasan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Wisata</label>
            <select name="id_wisata" class="form-control" required>
                <option value="">Pilih Wisata</option>
                @foreach($wisata as $w)
                    <option value="{{ $w->id_wisata }}">{{ $w->nama_wisata }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Komentar</label>
            <textarea name="komentar" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <select name="rating" class="form-control" required>
                <option value="">Pilih Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection

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
        <form action="{{ route('wisata.update', $wisata->id_wisata) }}" method="POST" enctype="multipart/form-data" id="editForm">
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="number" name="lat" value="{{ $wisata->lat }}" step="0.000001" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="number" name="long" value="{{ $wisata->long }}" step="0.000001" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Gambar Wisata A</label><br>
                @if($wisata->gambar_a)
                    <img src="{{ asset('images/wisata/' . $wisata->gambar_a) }}" width="150" class="mb-2 img-thumbnail">
                @else
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
                <input type="file" name="gambar_a" class="form-control-file" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <div class="form-group">
                <label>Gambar Wisata B</label><br>
                @if($wisata->gambar_b)
                    <img src="{{ asset('images/wisata/' . $wisata->gambar_b) }}" width="150" class="mb-2 img-thumbnail">
                @else
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
                <input type="file" name="gambar_b" class="form-control-file" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <button type="submit" class="btn btn-success update-btn">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('wisata.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

{{-- SweetAlert untuk Konfirmasi Update --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.update-btn').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: "Konfirmasi Update",
            text: "Apakah Anda yakin ingin memperbarui data wisata ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Update!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();
            }
        });
    });
</script>
@endsection

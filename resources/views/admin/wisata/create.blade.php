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
        <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Wisata</label>
                        <input type="text" name="nama_wisata" class="form-control @error('nama_wisata') is-invalid @enderror" 
                               value="{{ old('nama_wisata') }}" required>
                        @error('nama_wisata')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                                      
                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="number" name="lat" id="lat" step="any" class="form-control @error('lat') is-invalid @enderror"
                               value="{{ old('lat') }}" required>
                        @error('lat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="number" name="long" id="long" step="any" class="form-control @error('long') is-invalid @enderror"
                               value="{{ old('long') }}" required>
                        @error('long')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gambar Wisata 1</label>
                        <input type="file" name="gambar_a" id="gambar_a" class="form-control-file @error('gambar_a') is-invalid @enderror" accept="image/*">
                        <img id="preview_a" src="#" alt="Preview Gambar 1" style="max-width: 100%; margin-top: 10px; display: none;">
                        @error('gambar_a')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gambar Wisata 2</label>
                        <input type="file" name="gambar_b" id="gambar_b" class="form-control-file @error('gambar_b') is-invalid @enderror" accept="image/*">
                        <img id="preview_b" src="#" alt="Preview Gambar 2" style="max-width: 100%; margin-top: 10px; display: none;">
                        @error('gambar_b')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
</div>

@endsection

@section('scripts')
<!-- Leaflet untuk peta -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-7.250445, 112.768845], 13); // Default ke Surabaya
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    function updateLatLong(lat, lng) {
        document.getElementById('lat').value = lat;
        document.getElementById('long').value = lng;
    }

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        updateLatLong(lat, lng);
    });

    // Fungsi preview gambar
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    document.getElementById('gambar_a').addEventListener('change', function() {
        previewImage(this, 'preview_a');
    });

    document.getElementById('gambar_b').addEventListener('change', function() {
        previewImage(this, 'preview_b');
    });
</script>
@endsection

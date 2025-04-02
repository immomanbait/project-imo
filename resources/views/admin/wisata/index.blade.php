@extends('layouts.adminLayout.admin_desing')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Data Wisata</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('wisata.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Wisata</li>
            </ol>
        </div>
    </div>
</div>

@include('layouts.adminLayout.admin_messages')

<div class="card">
    <div class="card-body">
        <a href="{{ route('wisata.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Wisata
        </a>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Wisata</th>
                        <th>Nama Wisata</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                        <th>Kategori</th>
                        <th>Lokasi <br> (Lat, Long)</th>
                        <th>Gambar A</th>
                        <th>Gambar B</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $wisata)
                    <tr>
                        <td>{{ $wisata->id_wisata }}</td>
                        <td>{{ $wisata->nama_wisata }}</td>
                        <td>
                            <span data-toggle="tooltip" title="{{ $wisata->deskripsi }}">
                                {{ Str::limit($wisata->deskripsi, 50, '...') }}
                            </span>
                        </td>
                        <td>{{ $wisata->alamat }}</td>
                        <td>{{ $wisata->kategori->nama_kategori ?? 'N/A' }}</td>
                        <td>
                            @if(!empty($wisata->lat) && !empty($wisata->long))
                                {{ $wisata->lat }}, {{ $wisata->long }}
                            @else
                                <span class="text-muted">Tidak ada lokasi</span>
                            @endif
                        </td>
                        
                        <td>
                            <img src="{{ $wisata->gambar_a ? asset('images/wisata/' . $wisata->gambar_a) : asset('images/default.png') }}" 
                                 class="img-thumbnail" style="width: 80px; height: 60px;" alt="Gambar A">
                        </td>
                        <td>
                            <img src="{{ $wisata->gambar_b ? asset('images/wisata/' . $wisata->gambar_b) : asset('images/default.png') }}" 
                                 class="img-thumbnail" style="width: 80px; height: 60px;" alt="Gambar B">
                        </td>
                        <td>
                            <!-- Tombol Detail -->
                            <a href="{{ route('admin.wisata.show', $wisata->nama_wisata) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            
                            <!-- Tombol Edit -->
                            <a href="{{ route('wisata.edit', $wisata->id_wisata) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('wisata.destroy', $wisata->id_wisata) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete-btn">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SweetAlert untuk konfirmasi hapus --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                let form = this.closest("form");
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data wisata akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection

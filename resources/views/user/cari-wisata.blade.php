<x-navbar></x-navbar>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata</title>
    <link rel="stylesheet" href="{{ asset('inventory/css/wisata.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</head>
<body>
    <!-- Jumbotron -->
    <!-- Hero Section -->
<div class="jumbotron jumbotron-fluid position-relative text-center text-white" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url('{{ asset('images/wisata/' . $wisata->gambar_a) }}') center/cover no-repeat; height: 200px;">
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <h1 class="display-4 fw-bold">{{ $wisata->nama_wisata }}</h1>
        <p class="lead w-75">{{ $wisata->deskripsi }}</p>
    </div>
</div>


    <div class="container mt-4">
        <!-- Galeri Foto Wisata -->
        <div class="row align-items-center mb-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <img src="{{ asset('images/wisata/'.$wisata->gambar_a) }}" class="card-img-top rounded" alt="Foto 1">
                    </div>
                </div>
            <div class="col-md-6">
                <h6>
                    @if(isset($ulasan) && count($ulasan) > 2)
                        "{{ $ulasan->first()->komentar }}"
                    @else
                        "Belum ada ulasan untuk wisata ini."
                    @endif
                </h6>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <p>
                    @if(isset($ulasan) && count($ulasan) > 2)
                        "{{ $ulasan[1]->komentar }}"
                    @else
                        "Tambahkan ulasan untuk berbagi pengalaman Anda."
                    @endif
                </p>
            </div>
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <img src="{{ asset('images/wisata/'.$wisata->gambar_b) }}" class="card-img-top rounded" alt="Foto 2">
                </div>
            </div>
        </div>
    </div>
<!-- Peta Lokasi Wisata -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Lokasi Wisata</h3>
    <div id="map" style="height: 400px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);"></div>
</div>


<!-- Ulasan Wisata -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Ulasan Pengunjung</h3>
    @if(isset($ulasan) && count($ulasan) > 2)
        <div class="row">
            @foreach($ulasan as $u)
                <div class="col-md-4">
                    <div class="card p-3 shadow-lg border-0">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-circle fa-2x me-2 text-primary"></i>
                            <strong>Anonim</strong>
                        </div>
                        <p class="mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $u->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                        </p>
                        <p class="text-muted">{{ $u->komentar }}</p>
                        <small class="text-secondary">{{ \Carbon\Carbon::parse($u->tanggal)->format('d M Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">Belum ada ulasan untuk wisata ini.</p>
    @endif
</div>

<div class="mt-4 text-center">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ulasanModal">
        Tambahkan Ulasan
    </button>
</div>
<!-- Modal Form Ulasan -->
<div class="modal fade" id="ulasanModal" tabindex="-1" aria-labelledby="ulasanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ulasanModalLabel">Tambah Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_wisata" value="{{ $wisata->id_wisata }}">

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="">Pilih Rating</option>
                            <option value="1">1 - Buruk</option>
                            <option value="2">2 - Kurang</option>
                            <option value="3">3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="komentar" class="form-label">Ulasan</label>
                        <textarea name="komentar" id="komentar" rows="3" class="form-control" required></textarea>
                    </div>

                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>


                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
    <!-- Footer -->
    <!-- Footer -->
    <footer class="bg-dark text-white text-center w-100 py-4">
        <div class="container-fluid">
            <p class="mb-1">© {{ date('Y') }} Wisata. Kota Kupang.</p>
            <p class="mb-1">F & J Code</p>
            <div>
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
        </div>
    </footer>
    
    

    <!-- Bagian maps lokasi wisata -->
        <script>
            var map = L.map('map').setView([{{ $wisata->lat }}, {{ $wisata->long }}], 13);
        
            // Tambahkan layer peta
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
        
            // Tambahkan marker lokasi wisata
            var marker = L.marker([{{ $wisata->lat }}, {{ $wisata->long }}]).addTo(map)
                .bindPopup("<b>{{ $wisata->nama_wisata }}</b><br>{{ $wisata->deskripsi }}<br><a href='https://www.google.com/maps/dir/?api=1&destination={{ $wisata->lat }},{{ $wisata->long }}' target='_blank' style='color:blue; text-decoration:underline;'>Lihat Rute</a>")
                .openPopup();
        
            // Tambahkan event klik pada marker untuk langsung membuka Google Maps
            marker.on('click', function() {
                window.open('https://www.google.com/maps/dir/?api=1&destination={{ $wisata->lat }},{{ $wisata->long }}', '_blank');
            });
        </script>
        
    
    
    </body>
    <!-- Swiper.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.ulasan-swiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        }
    });
</script>

</html>
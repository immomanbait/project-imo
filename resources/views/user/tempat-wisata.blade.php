<x-navbar></x-navbar>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata</title>

    <link rel="stylesheet" href="{{ asset('css/wisata.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /* Tambahkan margin atas agar tidak tertutup navbar */
        .section-title {
            scroll-margin-top: 100px; /* Sesuaikan dengan tinggi navbar */
        }
    </style>
</head>
<body>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">Daftar Wisata Kota Kupang</h1>
        </div>
    </div>

    <!-- Panel Info -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 info-panel-wisata">
                <div class="row">
                    <div class="col-lg text-center">
                        <h2><i class="fas fa-minus"></i> Jelajahi Keindahan, Temukan Petualangan <i class="fas fa-minus"></i></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Wisata -->
    <div class="container">
        <!-- Kategori Alam -->
        <div class="category-section">
            <h1 id="kategori-alam" class="section-title">Kategori Alam</h1>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($wisatas as $wisata)
                        @if ($wisata->id_kategori == 1)
                            <div class="swiper-slide">
                                <a href="/wisatas/{{ $wisata->nama_wisata }}">
                                    <div class="image-container">
                                        <img src="{{ asset('images/wisata/'.$wisata->gambar_a) }}" alt="{{ $wisata->nama_wisata }}">
                                        <div class="image-text">{{ $wisata->nama_wisata }}</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- Kategori Budaya/Sejarah -->
        <div class="category-section">
            <h1 id="kategori-budaya" class="section-title">Kategori Budaya Sejarah</h1>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($wisatas as $wisata)
                        @if ($wisata->id_kategori == 2)
                            <div class="swiper-slide">
                                <a href="/wisatas/{{ $wisata->nama_wisata }}">
                                    <div class="image-container">
                                        <img src="{{ asset('images/wisata/'.$wisata->gambar_a) }}" alt="{{ $wisata->nama_wisata }}">
                                        <div class="image-text">{{ $wisata->nama_wisata }}</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- Kategori Buatan -->
        <div class="category-section">
            <h1 id="kategori-buatan" class="section-title">Kategori Wisata Buatan</h1>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($wisatas as $wisata)
                        @if ($wisata->id_kategori == 3)
                            <div class="swiper-slide">
                                <a href="/wisatas/{{ $wisata->nama_wisata }}">
                                    <div class="image-container">
                                        <img src="{{ asset('images/wisata/'.$wisata->gambar_a) }}" alt="{{ $wisata->nama_wisata }}">
                                        <div class="image-text">{{ $wisata->nama_wisata }}</div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Inisialisasi Swiper
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            }
        });

        // Smooth scrolling ke kategori dari URL
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash) {
                let element = document.querySelector(window.location.hash);
                if (element) {
                    setTimeout(() => {
                        element.scrollIntoView({ behavior: "smooth", block: "center" });
                    }, 100);
                }
            }
        });
    </script>

</body>
</html>

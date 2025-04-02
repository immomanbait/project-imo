<x-navbar></x-navbar>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logo.png" >

    <!-- Peta -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- jumbotron -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">WISATA KOTA KUPANG</h1>
        <p class="lead">Sistem informasi ini merupakan aplikasi pemetaan geografis lokasi wisata di Kota Kupang </p>

        <!-- Search Bar -->
        <div class="mt-2">
          <input style="max-width: 400px; background: rgba(255, 255, 255, 0.5); border: none; border-radius: 20px; padding: 10px;"
          type="search" name="search" id="search" class="form-control" placeholder="Cari lokasi wisata...">
          <!-- Dropdown untuk hasil pencarian -->
          <ul id="search-results" class="list-group position-absolute w-100 mt-1" 
              style="display: none; max-width: 400px; background: white; border-radius: 10px; z-index: 1000;">
          </ul>
        </div>

      </div>
    </div>
    <!-- end jumbotron -->

    <!-- container -->
     <div class="container">
        <!-- info panel -->
         <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <a href="/wisatas#kategori-alam">
                            <img src="img/destination.png" alt="map" class="float-left">
                            <h4>WISATA ALAM</h4>
                             
                        </a>
                    </div>
                    <div class="col-lg">
                        <a href="/wisatas#kategori-budaya">
                            <img src="img/budaya1.png" alt="data" class="float-left">
                            <h4>WISATA BUDAYA/SEJARAH</h4>
                            
                        </a>
                    </div>
                    <div class="col-lg">
                        <a href="/wisatas#kategori-buatan">
                            <img src="img/buatan.png" alt="about" class="float-left">
                            <h4>WISATA BUATAN</h4>
                           
                        </a>
                    </div>
                </div> 
            </div>
         </div>
         <!-- end info panel -->

        <!-- Map Space -->
        <div class="row map" id="lokasi-peta">
            <div class="col-12 order-0 order-md-0 map-content">
                <h3>LOKASI <span class="text-primary">WISATA</span></h3>
                <h5>LOKASI WISATA KOTA KUPANG</h5>
            </div>
            <div class="col-12">
                <div id="map" style="height: 500px;"></div>
            </div>
        </div>
    </div>
        <!-- end Map -->

        <!-- sction spotlight -->
        <section class="spotlight">
          <!-- Bagian kiri: teks -->
          <div class="spotlight-text">
            <p class="subheading">SPOTLIGHT</p>
            <h1 class="headline">Lokasi Wisata Terdekat</h1>
            <!-- Lokasi user tampil di sini (pakai ID "location") -->
            <p id="location" class="description">Mendeteksi lokasi...</p>
            <p class="description">
              Kami menemukan lokasi yang dekat dengan tempatmu, cek sekarang yuk!
            </p>
            <a href="/wisatas" class="hover:underline">
              <button class="explore-btn">Explore Lebih Banyak →</button>
            </a>

            <!-- Indikator slide -->
            <div class="slide-indicator">
              <span class="current-slide">1</span> / <span class="total-slides">3</span>
            </div>
          </div>

          <!-- Bagian kanan: carousel -->
          <div class="carousel-container">
            <div class="carousel" id="wisata-container">
              <!-- Konten dynamic akan dimasukkan dengan JS (displayWisata) -->
            </div>
            <!-- Tombol navigasi carousel -->
            <button class="prev-btn">‹</button>
            <button class="next-btn">›</button>
          </div>
        </section>



    <!-- Google Maps API -->
    <script>
      var map = L.map('map').setView([-10.1778, 123.5842], 13); // Koordinat Kupang

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      // Ambil data wisata dari Laravel
      var wisataData = @json($wisatas);

      // Tambahkan marker untuk setiap tempat wisata
      if (Array.isArray(wisataData) && wisataData.length > 0) {
        wisataData.forEach(function(wisata) {
          if (wisata.lat && wisata.long) {
            L.marker([wisata.lat, wisata.long]).addTo(map)
              .bindPopup(wisata.nama_wisata || "Tempat Wisata");
          }
        });
      } else {
        console.warn("Tidak ada data wisata yang tersedia.");
      }

      // Tambahkan marker lokasi pengguna
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;
            
                var userMarker = L.marker([userLat, userLng], {
                    icon: L.icon({
                        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41]
                    })
                }).addTo(map)
                  .bindPopup("Lokasi Anda")
                  .openPopup();
            
                // Pusatkan peta ke lokasi user
                map.setView([userLat, userLng], 13);
            }, function(error) {
                console.error("Geolocation error:", error.message);
            });
        } else {
            console.warn("Geolocation tidak didukung oleh browser ini.");
        }
    </script>

    <!-- Lokasi User -->
    <script>
    window.onload = function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(sendLocation, showError);
        } else {
            document.getElementById("location").innerHTML = "Geolocation tidak didukung oleh browser ini.";
        }
    };

    function sendLocation(position) {
    let latitude = position.coords.latitude.toFixed(6);
    let longitude = position.coords.longitude.toFixed(6);

    fetch('/store-location', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ latitude, longitude })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
        displayWisata(data);
    })
    .catch(error => console.error('Fetch error:', error));
    }

    // display wisata
    function displayWisata(wisataList) {
    const container = document.getElementById("wisata-container");
    container.innerHTML = ""; // Hapus data lama sebelum menampilkan yang baru

    wisataList.forEach(wisata => {
        let card = document.createElement("div");
        card.classList.add("card"); // ganti 'slide' menjadi 'card'

        // Gunakan encodeURIComponent agar nama wisata aman di-URL
        let linkWisata = `/wisatas/${encodeURIComponent(wisata.nama_wisata)}`;

        card.innerHTML = `
        <a href="${linkWisata}" class="slide-image">
            <div class="card-image">
                <img src="${wisata.gambar}" alt="${wisata.nama_wisata}">
            </div>
            <div class="overlay">
                <h3>${wisata.nama_wisata}</h3>
                <p>Jarak: ${wisata.jarak_km} km</p>
            </div>
        </a>
        `;

        container.appendChild(card);
    });

    // Opsional: update total slides
    document.querySelector(".total-slides").textContent = wisataList.length;
    }

    // Script Carousel (prev / next) + scroll:
    document.addEventListener("DOMContentLoaded", function () {
        const carousel = document.querySelector(".carousel");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        const currentSlideEl = document.querySelector(".current-slide");

        nextBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: 320, behavior: "smooth" });
            // Di sini bisa ditambahkan logika menghitung current slide
        });

        prevBtn.addEventListener("click", () => {
            carousel.scrollBy({ left: -320, behavior: "smooth" });
            // Di sini bisa ditambahkan logika menghitung current slide
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const carousel = document.querySelector(".carousel");
      const prevBtn = document.querySelector(".prev-btn");
      const nextBtn = document.querySelector(".next-btn");
      const currentSlideEl = document.querySelector(".current-slide");

      // --- [ A ] Tombol prev/next ---
      nextBtn.addEventListener("click", () => {
        carousel.scrollBy({ left: 320, behavior: "smooth" });
        // Jika ingin update current slide, tambahkan logic di sini
      });

      prevBtn.addEventListener("click", () => {
        carousel.scrollBy({ left: -320, behavior: "smooth" });
        // Jika ingin update current slide, tambahkan logic di sini
      });

      // --- [ B ] Drag-to-scroll ---

      let isDragging = false;
      let startX;       // posisi mouse saat klik (X)
      let scrollLeft;   // posisi scroll saat mouse down

      // Saat mouse ditekan
      carousel.addEventListener("mousedown", (e) => {
        isDragging = true;
        // Hitung posisi awal X dengan memperhitungkan jarak carousel
        startX = e.pageX - carousel.offsetLeft;
        // Simpan posisi scroll saat ini
        scrollLeft = carousel.scrollLeft;
      });
  
      // Saat mouse keluar area carousel atau diangkat
      carousel.addEventListener("mouseleave", () => {
        isDragging = false;
      });
      carousel.addEventListener("mouseup", () => {
        isDragging = false;
      });
  
      // Saat mouse digerakkan
      carousel.addEventListener("mousemove", (e) => {
        if (!isDragging) return; // kalau tidak sedang drag, abaikan
        e.preventDefault();
    
        // Hitung pergeseran X
        const x = e.pageX - carousel.offsetLeft;
        // Nilai "walk" menentukan seberapa jauh kita scroll
        const walk = x - startX; // bisa juga kalikan *1.5, dsb. untuk sensitifitas
    
        // Geser scroll ke kiri / kanan
        carousel.scrollLeft = scrollLeft - walk;
      });
    });
    


    function showError(error) {
        let locationElement = document.getElementById("location");
        switch (error.code) {
            case error.PERMISSION_DENIED:
                locationElement.innerHTML = "Izin lokasi ditolak oleh pengguna.";
                break;
            case error.POSITION_UNAVAILABLE:
                locationElement.innerHTML = "Informasi lokasi tidak tersedia.";
                break;
            case error.TIMEOUT:
                locationElement.innerHTML = "Permintaan lokasi melebihi waktu tunggu.";
                break;
            case error.UNKNOWN_ERROR:
                locationElement.innerHTML = "Terjadi kesalahan yang tidak diketahui.";
                break;
        }
    }
    </script>


     <!-- Search -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#search').on('input', function() {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: "{{ route('wisata.search') }}",
                type: "GET",
                data: { search: query },
                success: function(response) {
                    console.log("Response dari server:", response); // Debugging

                    let resultsContainer = $('#search-results');
                    resultsContainer.empty().show();

                    if (response.length > 0) {
                        response.forEach(function(item) {
                            let listItem = `<li class="list-group-item search-item hover:underline" data-name="${item}" 
                            style="cursor: pointer; transition: background-color 0.3s ease;">${item}</li>`;
                            resultsContainer.append(listItem);
                        });
                    } else {
                        resultsContainer.append('<li class="list-group-item text-muted">Tidak ditemukan</li>');
                    }
                }
            });
        } else {
            $('#search-results').empty().hide();
        }
    });

    // 🔥 Event listener harus dipasang sekali saja di luar ajax
    $(document).on('click', '.search-item', function() {
        let wisataNama = $(this).attr('data-name'); // Gunakan attr(), bukan data()
        console.log("Wisata yang diklik:", wisataNama); // Debugging
        if (wisataNama) {
            window.location.href = "/wisatas/" + encodeURIComponent(wisataNama);
        }
    });

    //even background ketika di pointer
    $(document).on("mouseenter", ".search-item", function() {
        $(this).css("background-color", "#f0f0f0"); // Warna saat hover
    });
    $(document).on("mouseleave", ".search-item", function() {
        $(this).css("background-color", ""); // Kembali ke default
    });

    // 🔥 Tutup dropdown saat klik di luar
    $(document).on("click", function(event) {
        if (!$(event.target).closest("#search, #search-results").length) {
            $("#search-results").hide();
        }
    });

});
</script>


</body>
</html>


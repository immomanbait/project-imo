<?php

use App\Http\Controllers\WisataController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\Wisata;
use App\Models\Ulasan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan web routes untuk aplikasi.
| Routes ini dimuat oleh RouteServiceProvider dalam grup "web".
|
*/

// Halaman utama
Route::get('/', [HomeController::class, 'index']);
Route::post('/store-location', [HomeController::class, 'store']);

// Halaman home (hanya untuk user yang sudah login)
Route::view('home', 'home')->middleware('auth');

// Pencarian Wisata
Route::get('/search-wisata', [WisataController::class, 'search'])->name('wisata.search');

// Menampilkan daftar wisata
Route::get('/wisatas', function () {
    return view('user.tempat-wisata', [
        'kategori' => Kategori::all(),
        'wisatas' => Wisata::all()
    ]);
});


// Menampilkan detail wisata berdasarkan nama wisata
Route::get('/wisatas/{wisata:nama_wisata}', function (Wisata $wisata, Request $request) {
    $ulasan = Ulasan::where('id_wisata', $wisata->id_wisata)->get(); // Ambil ulasan berdasarkan id_wisata
    return view('user.cari-wisata', compact('wisata', 'ulasan'));
});



// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard'); // Menambahkan route admin.dashboard
    Route::get('/search-wisata', [AdminController::class, 'searchWisata'])->name('admin.wisata.search');
    Route::get('/wisatas/{nama_wisata}', [AdminController::class, 'showWisata'])->name('admin.wisata.show');
});

// Data Lokasi dan Ulasan
Route::get('/dataLokasi', [WisataController::class, 'index']);


Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');


// Login admin
Route::post('login-post', [AdminController::class, 'login']);

// Group route khusus untuk administrator dengan middleware role:admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [AdminController::class, 'index']);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/wisata', WisataController::class);
    Route::resource('/ulasan', UlasanController::class)->except(['store']);
    Route::get('/Ulasan', [UlasanController::class, 'index']); // Admin hanya mengelola ulasan, tidak menyimpan
});

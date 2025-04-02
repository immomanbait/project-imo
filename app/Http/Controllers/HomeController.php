<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'store']);
    }

    public function index()
    {
        $wisatas = Wisata::all(); // Ambil semua data wisata
        return view('welcome', compact('wisatas'));
    }

    public function store(Request $request)
    {
        // Validasi request
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Ambil lokasi user dengan pembulatan 2 angka di belakang koma
    $userLat = round($request->latitude, 2);
    $userLng = round($request->longitude, 2);

    // Ambil data wisata dari database dan bulatkan koordinatnya
    $wisataList = Wisata::select('nama_wisata', 'lat', 'long', 'gambar_a')->get()
            ->map(function ($wisata) {
                $wisata->lat = round($wisata->lat, 2);
                $wisata->long = round($wisata->long, 2);
                return $wisata;
            });

    // Hitung jarak dengan Euclidean Distance dan konversi ke km
    $jarakWisata = [];
    foreach ($wisataList as $wisata) {
        $euclideanDistance = sqrt(pow(($wisata->lat - $userLat), 2) + pow(($wisata->long - $userLng), 2));
        $distanceInKm = $euclideanDistance * 111.32; // Konversi ke kilometer
        $jarakWisata[] = [
            'nama_wisata' => $wisata->nama_wisata,
            'latitude' => $wisata->lat,
            'longitude' => $wisata->long,
            'gambar'      => asset('images/wisata/'.$wisata->gambar_a),
            'jarak_km' => round($distanceInKm, 2) // Bulatkan ke 2 desimal
        ];
    }

    /// Urutkan berdasarkan jarak terdekat
    usort($jarakWisata, fn($a, $b) => $a['jarak_km'] <=> $b['jarak_km']);

    // Ambil 3 lokasi terdekat
    return response()->json(array_slice($jarakWisata, 0, 3));
    }
}


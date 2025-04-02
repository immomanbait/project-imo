<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Wisata;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Menampilkan semua ulasan
    public function index()
    {
        $data = Ulasan::with('wisata')->get();
        return view('admin.ulasan.index', compact('data'));
    }

    // Menampilkan form tambah ulasan
    public function create()
    {
        $wisata = Wisata::all();
        return view('user.ulasan.create', compact('wisata'));
    }

    // Menyimpan ulasan baru
    public function store(Request $request)
    {
        $request->validate([
            'id_wisata' => 'required|exists:wisata,id_wisata',
            'komentar' => 'required|string|min:5|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'tanggal' => 'nullable|date',
        ]);

        Ulasan::create([
            'id_wisata' => $request->id_wisata,
            'komentar' => strip_tags($request->komentar), // Hindari script injection
            'rating' => $request->rating,
            'tanggal' => $request->tanggal ?? now()->toDateString(), // Default ke hari ini jika kosong
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }

    // Menampilkan form edit ulasan
    public function edit($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $wisata = Wisata::all();
        return view('user.ulasan.edit', compact('ulasan', 'wisata'));
    }

    // Memperbarui ulasan
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_wisata' => 'required|exists:wisata,id_wisata',
            'komentar' => 'required|string|min:5|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'tanggal' => 'nullable|date',
        ]);

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->update([
            'id_wisata' => $request->id_wisata,
            'komentar' => strip_tags($request->komentar),
            'rating' => $request->rating,
            'tanggal' => $request->tanggal ?? now()->toDateString(),
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    // Menghapus ulasan
    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}

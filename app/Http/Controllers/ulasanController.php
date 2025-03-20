<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Wisata;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $data = Ulasan::with('wisata')->get(); // Include relasi wisata
        return view('ulasan.index', compact('data'));
    }

    public function create()
    {
        $wisata = Wisata::all(); // Untuk select wisata
        return view('ulasan.create', compact('wisata'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_wisata' => 'required|exists:wisata,id_wisata',
            'komentar' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'tanggal' => 'required|date',
        ]);

        Ulasan::create($request->all());

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $wisata = Wisata::all();
        return view('ulasan.edit', compact('ulasan', 'wisata'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_wisata' => 'required|exists:wisata,id_wisata',
            'komentar' => 'required',
            'rating' => 'required|numeric|min:0|max:5',
            'tanggal' => 'required|date',
        ]);

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->update($request->all());

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}

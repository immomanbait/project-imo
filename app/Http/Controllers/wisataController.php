<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    // Menampilkan semua data wisata
    public function index()
    {
        $data = Wisata::with('kategori')->get(); // optional with kategori kalau relasi dibuat
        return view('wisata.index', compact('data'));
    }

    // Tampilkan form tambah wisata
    public function create()
    {
        $kategori = Kategori::all();
        return view('wisata.create', compact('kategori'));
    }

    // Simpan data wisata baru
    public function store(Request $request)
    {
        $request->validate([
            'id_wisata' => 'required|numeric|unique:wisata,id_wisata',
            'nama_wisata' => 'required|string|max:50',
            'deskripsi' => 'required',
            'alamat' => 'required|string|max:50',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        Wisata::create($request->all());

        return redirect()->route('Wisata.index')->with('success', 'Data wisata berhasil ditambahkan.');
    }

    // Tampilkan form edit wisata
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        $kategori = Kategori::all();
        return view('wisata.edit', compact('wisata', 'kategori'));
    }

    // Update data wisata
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:50',
            'deskripsi' => 'required',
            'alamat' => 'required|string|max:50',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        $wisata = Wisata::findOrFail($id);
        $wisata->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data wisata berhasil diupdate.');
    }

    // Hapus data wisata
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata->delete();

        return redirect()->route('kategori.index')->with('success', 'Data wisata berhasil dihapus.');
    }
}

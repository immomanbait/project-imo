<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $data = Kategori::all();
        return view('admin.kategori.index', compact('data'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            
            'nama_kategori' => 'required|string|max:25',
        ]);

        Kategori::create([
            
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:25',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

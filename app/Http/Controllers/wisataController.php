<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request)
{
    $query = Wisata::query();

    // Pencarian berdasarkan nama wisata atau alamat
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama_wisata', 'LIKE', "%{$search}%")
              ->orWhere('alamat', 'LIKE', "%{$search}%");
    }

    $data = $query->with('kategori')->get();

    return view('admin.wisata.index', compact('data'));
}

public function search(Request $request)
{
    $search = $request->input('search');

    $wisatas = Wisata::where('nama_wisata', 'like', "%{$search}%")->pluck('nama_wisata');


    return response()->json($wisatas);
}

    public function show(Wisata $wisata)
    {
           // Ambil data wisata berdasarkan ID
        $wisata = Wisata::findOrFail($id);

    // Ambil ulasan berdasarkan ID wisata
        $ulasan = Ulasan::where('id_wisata', $id)->get(); // 

    // Kirim data ke view
        return view('user.cari-wisata', compact('wisata', 'ulasan'));
    }
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.wisata.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:100',
            'deskripsi' => 'required',
            'alamat' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'gambar_a' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_b' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['gambar_a', 'gambar_b']);

        if ($request->hasFile('gambar_a')) {
            $filenameA = time() . '_a_' . $request->file('gambar_a')->getClientOriginalName();
            $request->file('gambar_a')->move(public_path('images/wisata'), $filenameA);
            $data['gambar_a'] = $filenameA;
        }

        if ($request->hasFile('gambar_b')) {
            $filenameB = time() . '_b_' . $request->file('gambar_b')->getClientOriginalName();
            $request->file('gambar_b')->move(public_path('images/wisata'), $filenameB);
            $data['gambar_b'] = $filenameB;
        }

        Wisata::create($data);

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.wisata.edit', compact('wisata', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:100',
            'deskripsi' => 'required',
            'alamat' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',
            'gambar_a' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_b' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $wisata = Wisata::findOrFail($id);
        $data = $request->except(['gambar_a', 'gambar_b']);

        if ($request->hasFile('gambar_a')) {
            if (!empty($wisata->gambar_a) && file_exists(public_path('images/wisata/' . $wisata->gambar_a))) {
                unlink(public_path('images/wisata/' . $wisata->gambar_a));
            }
            $filenameA = time() . '_a_' . $request->file('gambar_a')->getClientOriginalName();
            $request->file('gambar_a')->move(public_path('images/wisata'), $filenameA);
            $data['gambar_a'] = $filenameA;
        }

        if ($request->hasFile('gambar_b')) {
            if (!empty($wisata->gambar_b) && file_exists(public_path('images/wisata/' . $wisata->gambar_b))) {
                unlink(public_path('images/wisata/' . $wisata->gambar_b));
            }
            $filenameB = time() . '_b_' . $request->file('gambar_b')->getClientOriginalName();
            $request->file('gambar_b')->move(public_path('images/wisata'), $filenameB);
            $data['gambar_b'] = $filenameB;
        }

        $wisata->update($data);

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        if (!empty($wisata->gambar_a) && file_exists(public_path('images/wisata/' . $wisata->gambar_a))) {
            unlink(public_path('images/wisata/' . $wisata->gambar_a));
        }
        if (!empty($wisata->gambar_b) && file_exists(public_path('images/wisata/' . $wisata->gambar_b))) {
            unlink(public_path('images/wisata/' . $wisata->gambar_b));
        }

        $wisata->delete();

        return redirect()->route('wisata.index')->with('success', 'Data wisata berhasil dihapus.');
    }
}

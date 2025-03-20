<?php

namespace App\Http\Controllers;
use App\Models\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index()
    {
        $data = kategori::all();
        return view('kategori', compact('data'));
    }
}

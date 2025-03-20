<?php

namespace App\Http\Controllers;
use App\Models\wisata;
use Illuminate\Http\Request;

class wisataController extends Controller
{
    public function index()
    {
        $data = wisata::all();
        return view('wisata', compact('data'));
    }
}

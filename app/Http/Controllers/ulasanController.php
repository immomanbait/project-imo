<?php

namespace App\Http\Controllers;
use App\Models\ulasan;
use Illuminate\Http\Request;

class ulasanController extends Controller
{
    public function index()
    {
        $data = ulasan::all();
        return view('ulasan', compact('data'));
    }
}

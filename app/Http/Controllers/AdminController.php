<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Uncomment the constructor if you want to enforce role-based access control
    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($request->isMethod('post')) {
            $data = $request->only('email', 'password'); // Ambil hanya email dan password

            // Coba untuk login
            if (Auth::attempt($data)) {
                // Jika login berhasil, periksa peran pengguna
                if (auth()->user()->hasRole('admin')) {
                    return redirect('/administrator/home')->with('flash_message_success', 'Login Berhasil');
                } elseif (auth()->user()->hasRole('user')) {
                    return redirect('/user/home')->with('flash_message_success', 'Anda adalah User');
                }
            } else {
                // Jika login gagal
                return redirect('/login')->with('flash_message_error', 'Invalid Username or Password');
            }
        }

        // Tampilkan halaman login jika bukan permintaan POST
        return view('admin.home');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses Login (Simulasi Alur Pengalihan Role)
    public function login(Request $request)
    {
        $email = $request->input('email');
        
        // Simulasi: Jika input email mengandung kata 'admin', masuk sebagai Admin
        if (str_contains(strtolower($email), 'admin')) {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
        }
        
        // Default: Masuk sebagai Warga (User)
        return redirect()->route('user.dashboard')->with('success', 'Selamat datang Warga!');
    }

    // Menampilkan Halaman Register Warga
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses Registrasi Warga
    public function register(Request $request)
    {
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk.');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        return redirect()->route('login')->with('success', 'Anda telah keluar.');
    }
}
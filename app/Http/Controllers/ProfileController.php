<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        return view('profile.edit');
    }

    // Memproses pembaruan data profil
    public function update(Request $request)
    {
        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
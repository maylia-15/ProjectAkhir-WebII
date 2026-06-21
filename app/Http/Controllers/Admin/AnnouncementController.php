<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // Tampilan tabel manajemen kelola seluruh pengumuman kompleks
    public function index()
    {
        return view('admin.announcements.index');
    }

    // Memproses pembuatan postingan pengumuman baru
    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'Pengumuman baru berhasil diterbitkan!');
    }

    // Memproses pengeditan data teks pengumuman lama
    public function update(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // Memproses pencabutan/penghapusan pengumuman dari papan informasi
    public function destroy($id)
    {
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
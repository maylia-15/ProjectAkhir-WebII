<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Utama Warga (Menampilkan Statistik Laporan + Card Pengumuman)
    public function index()
    {
        return view('user.dashboard.index');
    }
}
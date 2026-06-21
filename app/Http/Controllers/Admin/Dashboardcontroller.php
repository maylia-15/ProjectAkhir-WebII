<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Utama Panel Admin (Ringkasan Total Angka Statistik)
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
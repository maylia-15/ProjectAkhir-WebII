<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // Tampilan daftar database tabel warga kompleks yang sudah memiliki akun (Read-Only)
    public function index()
    {
        return view('admin.wargas.index');
    }
}
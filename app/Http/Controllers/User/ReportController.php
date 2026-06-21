<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Tampilan daftar semua laporan milik warga yang login
    public function index()
    {
        return view('user.reports.index');
    }

    // Tampilan formulir pembuatan laporan baru
    public function create()
    {
        return view('user.reports.create');
    }

    // Memproses penyimpanan data laporan baru ke sistem
    public function store(Request $request)
    {
        return redirect()->route('user.reports.index')->with('success', 'Laporan aduan berhasil dikirim!');
    }

    // Tampilan detail pelacakan (tracking) satu laporan tertentu
    public function show($id)
    {
        return view('user.reports.show');
    }

    // Tampilan formulir untuk mengedit data laporan lama
    public function edit($id)
    {
        return view('user.reports.edit');
    }

    // Memproses pembaruan data laporan lama
    public function update(Request $request, $id)
    {
        return redirect()->route('user.reports.index')->with('success', 'Perubahan laporan berhasil disimpan.');
    }

    // Memproses pembatalan/penghapusan laporan oleh warga
    public function destroy($id)
    {
        return redirect()->route('user.reports.index')->with('success', 'Laporan berhasil dibatalkan.');
    }
}
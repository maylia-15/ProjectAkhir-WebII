<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Tampilan seluruh kotak masuk data laporan masuk dari warga kompleks
    public function index()
    {
        return view('admin.reports.index');
    }

    // Tampilan detail aduan warga untuk proses pemeriksaan validasi
    public function show($id)
    {
        return view('admin.reports.show');
    }

    // Memproses perubahan status (Misal: Menunggu -> Diproses / Selesai)
    public function updateStatus(Request $request, $id)
    {
        return redirect()->route('admin.reports.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    // Memproses penghapusan laporan warga jika terdeteksi data palsu/spam
    public function destroy($id)
    {
        return redirect()->route('admin.reports.index')->with('success', 'Laporan aduan berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Dashboard Admin.
     *
     * Sesuai konsep UI Admin:
     * - Section Ringkasan Total: 4 card (Total Masuk, Menunggu Validasi, Diproses, Selesai)
     * - Card Laporan Terbaru: batasi hanya 5 laporan terbaru
     */
    public function index(): View
    {
        $ringkasan = [
            'total' => Report::count(),
            'menunggu' => Report::status('menunggu')->count(),
            'diproses' => Report::status('diproses')->count(),
            'selesai' => Report::status('selesai')->count(),
        ];

        $laporanTerbaru = Report::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', [
            'ringkasan' => $ringkasan,
            'laporanTerbaru' => $laporanTerbaru,
        ]);
    }
}
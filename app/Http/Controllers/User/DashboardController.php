<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan Halaman Dashboard User.
     *
     * Sesuai konsep UI User (revisi final + desain Naufal):
     * - Section Ringkasan: 4 card (Total, Menunggu, Diproses, Selesai)
     * - Tabel Laporan Terbaru: 5 laporan terakhir milik user (dengan kategori & lokasi)
     * - Section Pengumuman Terbaru: 3 pengumuman teratas dari admin dalam bentuk card
     *   (BUKAN menu sidebar terpisah - hanya tampil di sini)
     */
    public function index(): View
    {
        $userId = Auth::id();

        $ringkasan = [
            'total' => Report::milikUser($userId)->count(),
            'menunggu' => Report::milikUser($userId)->status('menunggu')->count(),
            'diproses' => Report::milikUser($userId)->status('diproses')->count(),
            'selesai' => Report::milikUser($userId)->status('selesai')->count(),
        ];

        $laporanTerbaru = Report::with('category')
            ->milikUser($userId)
            ->latest()
            ->take(5)
            ->get();

        $pengumumanTerbaru = Announcement::latest()
            ->take(3)
            ->get();

        return view('user.dashboard.index', [
            'ringkasan' => $ringkasan,
            'laporanTerbaru' => $laporanTerbaru,
            'pengumumanTerbaru' => $pengumumanTerbaru,
        ]);
    }
}
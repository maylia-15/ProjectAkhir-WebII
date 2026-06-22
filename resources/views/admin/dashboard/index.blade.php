{{--
    Dashboard Admin. Variabel dari AdminDashboardController@index:
    - $ringkasan (array: total, menunggu, diproses, selesai)
    - $laporanTerbaru (Collection of Report, max 5, with user & category)

    PERBAIKAN dari kode Naufal:
    - 3 card hardcode → 4 card dinamis dari $ringkasan (tambah Total Laporan Masuk)
    - Angka hardcode (5, 2, 120) → {{ $ringkasan[...] }}
    - DITAMBAHKAN: Card Laporan Terbaru (5 terbaru, sesuai konsep UI Admin)
--}}
@extends('layouts.admin')
@section('title', 'Dashboard Admin - BiSa')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 pb-12">

    <h2 class="text-2xl font-black text-slate-900">Dashboard Statistik</h2>

    {{-- 4 Card Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-3">Total Laporan Masuk</p>
                <p class="text-3xl font-black text-slate-900">{{ $ringkasan['total'] }}</p>
            </div>
            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-clipboard-list text-slate-600"></i>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-3">Menunggu Validasi</p>
                <p class="text-3xl font-black text-slate-900">{{ $ringkasan['menunggu'] }}</p>
            </div>
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <i class="fa-regular fa-clock text-amber-500"></i>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-3">Sedang Diproses</p>
                <p class="text-3xl font-black text-slate-900">{{ $ringkasan['diproses'] }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-bolt text-blue-500"></i>
            </div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between items-start">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-3">Laporan Selesai</p>
                <p class="text-3xl font-black text-slate-900">{{ $ringkasan['selesai'] }}</p>
            </div>
            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                <i class="fa-regular fa-circle-check text-emerald-500"></i>
            </div>
        </div>
    </div>

    {{-- Card Laporan Terbaru (5 terbaru) --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-900">Laporan Terbaru</h3>
            <a href="{{ route('admin.reports.index') }}" class="text-[13px] font-bold text-[#1a8e5f] hover:underline bg-emerald-50 px-3 py-1.5 rounded-lg">Lihat semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 min-w-[700px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Pelapor</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($laporanTerbaru as $laporan)
                        @php
                            $statusStyle = match ($laporan->status) {
                                'menunggu' => 'bg-amber-100 text-amber-600',
                                'diproses' => 'bg-blue-100 text-blue-600',
                                'selesai'  => 'bg-emerald-100 text-emerald-600',
                                'ditolak'  => 'bg-rose-100 text-rose-600',
                                default    => 'bg-slate-100 text-slate-600',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4 font-medium text-slate-700">{{ $laporan->user->name }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900">{{ \Illuminate\Support\Str::limit($laporan->judul, 40) }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">{{ $laporan->category->nama_kategori }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="{{ $statusStyle }} px-3 py-1 rounded-full text-[11px] font-bold">{{ ucfirst($laporan->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs font-medium">{{ $laporan->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.reports.show', $laporan) }}" class="text-[#1a8e5f] font-bold text-xs hover:underline">Periksa &rarr;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada laporan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
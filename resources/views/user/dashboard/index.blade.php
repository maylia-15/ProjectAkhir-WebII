{{--
    Dashboard User. Diadaptasi penuh ke Konsep & Desain Gambar Revisi Final.
    Variabel dari UserDashboardController@index:
    - $ringkasan (array: total, menunggu, diproses, selesai)
    - $laporanTerbaru (Collection of Report, max 5, with category)
    - $pengumumanTerbaru (Collection of Announcement, max 3)

    REVISI: $pengumumanBanner dihapus (diganti sliding banner @foreach semua pengumuman).
    labelTipe() dihapus (kolom tipe sudah tidak ada di tabel announcements).
--}}
@extends('layouts.user')
@section('title', 'Dashboard - BISA')
@section('content')
<div class="space-y-8 max-w-6xl mx-auto pb-12">

    {{-- Area Header Welcome --}}
    <div>
        <h2 class="text-[28px] md:text-3xl font-black text-slate-900 mb-1 tracking-tight">Selamat datang, {{ auth()->user()->name }}!</h2>
        <p class="text-slate-500 text-sm font-medium">Unit: {{ auth()->user()->blok_rumah }}</p>
    </div>

    {{-- Banner Pengumuman Atas: bisa digeser/slide jika lebih dari 1 --}}
    @if ($pengumumanTerbaru && $pengumumanTerbaru->isNotEmpty())
        <div class="space-y-2">
            <div class="w-full flex overflow-x-auto snap-x snap-mandatory gap-4 pb-3 scrollbar-none select-none scroll-smooth">
                @foreach ($pengumumanTerbaru as $pengumuman)
                    <div class="w-full shrink-0 snap-start snap-always bg-gradient-to-r from-emerald-50 to-[#f0fdf4] rounded-2xl p-6 border border-emerald-100 flex gap-4 shadow-sm">
                        <div class="mt-1"><i class="fa-solid fa-bullhorn text-[#1a8e5f] text-2xl drop-shadow-sm"></i></div>
                        <div class="flex-1">
                            <div class="mb-2">
                                <h2 class="text-lg font-bold text-slate-900">{{ $pengumuman->judul }}</h2>
                            </div>
                            <p class="text-[13px] md:text-sm text-slate-600 leading-relaxed pr-4 whitespace-pre-line">{{ $pengumuman->isi }}</p>
                            <div class="flex items-center justify-between mt-4 pt-2 border-t border-emerald-100/40">
                                <span class="text-xs font-bold text-slate-500">{{ $pengumuman->created_at->format('d M Y') }}</span>
                                @if ($pengumumanTerbaru->count() > 1)
                                    <span class="text-[10px] bg-emerald-100 text-emerald-700 font-bold px-2 py-0.5 rounded-full animate-pulse">Geser &rarr;</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Indikator Dots Kecil Slider (Hanya muncul jika pengumuman > 1) --}}
            @if ($pengumumanTerbaru->count() > 1)
                <div class="flex justify-center gap-1.5 pt-1">
                    @foreach ($pengumumanTerbaru as $index => $p)
                        <span class="h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-4 bg-[#1a8e5f]' : 'w-1.5 bg-emerald-200' }}"></span>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- 4 Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total Laporan</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $ringkasan['total'] }}</p>
            </div>
            <div class="w-11 h-11 bg-[#1a8e5f] rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-solid fa-clipboard-list text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Menunggu</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $ringkasan['menunggu'] }}</p>
            </div>
            <div class="w-11 h-11 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-regular fa-clock text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Diproses</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $ringkasan['diproses'] }}</p>
            </div>
            <div class="w-11 h-11 bg-blue-500 rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-solid fa-bolt text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Selesai</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $ringkasan['selesai'] }}</p>
            </div>
            <div class="w-11 h-11 bg-[#10b981] rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-regular fa-circle-check text-lg"></i></div>
        </div>
    </div>

    {{-- Tabel Laporan Terbaru --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm mt-6">
        <div class="px-6 py-5 flex justify-between items-center border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Laporan Terbaru</h3>
            <a href="{{ route('user.reports.index') }}" class="text-[13px] font-bold text-[#1a8e5f] hover:underline bg-emerald-50 px-3 py-1.5 rounded-lg">Lihat semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($laporanTerbaru as $laporan)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4 font-bold text-slate-900">
                                <a href="{{ route('user.reports.show', $laporan) }}" class="hover:text-[#1a8e5f]">{{ $laporan->judul }}</a>
                            </td>
                            <td class="px-6 py-4"><span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">{{ $laporan->category->nama_kategori }}</span></td>
                            <td class="px-6 py-4 text-slate-500 font-medium">{{ $laporan->lokasi }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusStyle = match ($laporan->status) {
                                        'menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'selesai'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'ditolak'  => 'bg-rose-50 text-rose-700 border-rose-200',
                                        default    => 'bg-slate-50 text-slate-700 border-slate-200',
                                    };
                                @endphp
                                <span class="{{ $statusStyle }} border px-3 py-1 rounded-full text-[11px] font-bold">{{ ucfirst($laporan->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 font-medium">{{ $laporan->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">Anda belum membuat laporan apapun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
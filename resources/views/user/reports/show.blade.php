{{--
    Detail & Tracking Laporan. Diadaptasi dari desain Naufal (FrontEnd).
    Variabel dari UserReportController@show:
    - $report (with category, tags)

    PERBAIKAN dari kode asli Naufal:
    - Timeline "Pelacakan Laporan" ala tracking ojol DIHAPUS (sesuai keputusan:
      cukup badge status besar, lebih simpel)
    - DITAMBAHKAN: 3 info box di atas (Pelapor, Kategori, Tanggal Laporan)
    - DITAMBAHKAN: Tags sebagai hashtag (bg-emerald-100 text-emerald-700)
    - DITAMBAHKAN: Lokasi & Deskripsi (sebelumnya hilang total)
    - DITAMBAHKAN: tombol Edit Laporan & Hapus Laporan (kondisional sesuai status)
--}}
@extends('layouts.user')
@section('title', 'Detail Laporan')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto pb-12">
    <a href="{{ route('user.reports.index') }}" class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2 w-max transition">
        <i class="fa-solid fa-chevron-left text-xs"></i> Kembali ke Daftar Laporan
    </a>

    {{-- 3 Info Box: Pelapor, Kategori, Tanggal Laporan --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 select-none">Pelapor</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->user->name }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 select-none">Kategori</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->category->nama_kategori }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 select-none">Tanggal Laporan</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->created_at->format('Y-m-d') }}</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-6">
        <div class="border-b border-gray-100 pb-5">
            @php
                // Penyesuaian Style Warna berdasarkan Berkas Konsep Final
                $statusStyle = match ($report->status) {
                    'menunggu' => 'bg-amber-100 text-amber-600 border-amber-200/60',
                    'diproses' => 'bg-blue-100 text-blue-600 border-blue-200/60',
                    'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200/60',
                    'ditolak' => 'bg-rose-100 text-rose-600 border-rose-200/60',
                    default => 'bg-slate-100 text-slate-600 border-slate-200/60',
                };
            @endphp
            <span class="{{ $statusStyle }} border px-3 py-1 rounded-full text-xs font-black select-none">{{ ucfirst($report->status) }}</span>

            <h3 class="text-2xl font-black text-slate-900 mt-4 tracking-tight">{{ $report->judul }}</h3>

            {{-- Tags sebagai hashtag --}}
            @if ($report->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach ($report->tags as $tag)
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-bold px-2.5 py-1 rounded-full select-none">#{{ $tag->nama_tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 select-none">Lokasi Kompleks</p>
            <p class="text-sm font-bold text-slate-900 bg-slate-50 border border-slate-100 rounded-lg p-3">{{ $report->lokasi }}</p>
        </div>

        <div>
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 select-none">Deskripsi Masalah</p>
            <p class="text-sm text-slate-700 leading-relaxed bg-slate-50 border border-slate-100 rounded-lg p-3 whitespace-pre-line">{{ $report->deskripsi }}</p>
        </div>

        {{-- Tombol Edit & Hapus hanya muncul jika status masih "menunggu" --}}
        @if ($report->bisaDiubahWarga())
            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('user.reports.edit', $report) }}"
                   class="flex-1 text-center bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-lg shadow-sm transition cursor-pointer">
                    Edit Laporan
                </a>
                <form action="{{ route('user.reports.destroy', $report) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Yakin ingin membatalkan laporan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-white border border-rose-300 text-rose-600 hover:bg-rose-50 font-bold py-3 rounded-lg transition cursor-pointer">
                        Hapus Laporan
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
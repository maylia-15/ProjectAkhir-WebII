{{--
    Detail & Validasi Laporan (Admin). Variabel dari AdminReportController@show:
    - $report (with user, category, tags)

    Sesuai konsep UI Admin — Panel Aksi KONDISIONAL berdasarkan status:
    ┌─────────────────┬─────────────────────────────────────────────────────────┐
    │ Status Saat Ini │ Tombol yang Tampil                                      │
    ├─────────────────┼─────────────────────────────────────────────────────────┤
    │ menunggu        │ [Setujui & Proses] [Tolak Laporan] [Hapus dari Sistem]  │
    │ diproses        │ [Tandai Selesai] [Tolak Laporan] [Hapus dari Sistem]    │
    │ selesai         │ (tidak ada tombol aksi — laporan sudah final) [Hapus]   │
    │ ditolak         │ (tidak ada tombol aksi — laporan sudah final) [Hapus]   │
    └─────────────────┴─────────────────────────────────────────────────────────┘

    PERBAIKAN dari kode Naufal:
    - Semua data hardcode → variabel dinamis dari $report
    - Panel aksi kondisional per status (sebelumnya cuma 1 tombol "Setujui & Proses")
    - Input status dikirim via hidden field (sesuai UpdateStatusRequest)
    - Tambah info lengkap: Kategori, Lokasi, Deskripsi, Tags hashtag
    - Route Model Binding (hapus hardcode angka 1)
--}}
@extends('layouts.admin')
@section('title', 'Detail Laporan - BISA')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">

    <a href="{{ route('admin.reports.index') }}"
       class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2">
        <i class="fa-solid fa-chevron-left text-xs"></i> Kembali ke Data Laporan
    </a>

    {{-- 3 Info Box: Pelapor, Kategori, Tanggal Laporan --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Pelapor</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->user->name }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Unit {{ $report->user->blok_rumah }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Kategori</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->category->nama_kategori }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal Laporan</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->created_at->format('d M Y') }}</p>
        </div>
    </div>

    {{-- Detail Laporan --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-5">
        <div class="border-b border-gray-100 pb-4">
            @php
                $statusStyle = match ($report->status) {
                    'menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
                    'selesai'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'ditolak'  => 'bg-rose-50 text-rose-700 border-rose-200',
                    default    => 'bg-slate-50 text-slate-700 border-slate-200',
                };
            @endphp
            <span class="{{ $statusStyle }} border px-3 py-1 rounded-full text-xs font-bold">{{ ucfirst($report->status) }}</span>
            <h3 class="text-xl font-black text-slate-900 mt-3">{{ $report->judul }}</h3>

            {{-- Tags hashtag --}}
            @if ($report->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($report->tags as $tag)
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full">#{{ $tag->nama_tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Lokasi</p>
            <p class="text-sm font-bold text-slate-900">{{ $report->lokasi }}</p>
        </div>

        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Deskripsi</p>
            <p class="text-sm text-slate-700 leading-relaxed">{{ $report->deskripsi }}</p>
        </div>
    </div>

    {{-- Panel Aksi Validasi (kondisional sesuai status) --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-4">
        <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-l-4 border-[#1a8e5f] pl-3">Panel Aksi Validasi</h4>

        @if ($report->status === 'menunggu')
            {{-- STATUS: menunggu → Setujui & Proses ATAU Tolak --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST" class="flex-1">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="diproses">
                    <button type="submit"
                        class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-sm transition">
                        <i class="fa-solid fa-circle-check mr-2"></i> Setujui & Proses
                    </button>
                </form>
                <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Yakin tolak laporan ini sebagai aduan palsu/tidak valid?')">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit"
                        class="w-full bg-white border border-rose-300 text-rose-600 hover:bg-rose-50 font-bold py-3 rounded-xl transition">
                        <i class="fa-solid fa-ban mr-2"></i> Tolak Laporan
                    </button>
                </form>
            </div>

        @elseif ($report->status === 'diproses')
            {{-- STATUS: diproses → Tandai Selesai ATAU Tolak --}}
            <div class="flex flex-col sm:flex-row gap-3">
                <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST" class="flex-1">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="selesai">
                    <button type="submit"
                        class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow-sm transition">
                        <i class="fa-solid fa-flag-checkered mr-2"></i> Tandai Selesai
                    </button>
                </form>
                <form action="{{ route('admin.reports.updateStatus', $report) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Yakin tolak laporan yang sedang diproses ini?')">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit"
                        class="w-full bg-white border border-rose-300 text-rose-600 hover:bg-rose-50 font-bold py-3 rounded-xl transition">
                        <i class="fa-solid fa-ban mr-2"></i> Tolak Laporan
                    </button>
                </form>
            </div>

        @elseif ($report->status === 'selesai')
            {{-- STATUS: selesai → tampilkan info saja, tidak ada tombol ubah status --}}
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                <p class="text-sm font-semibold text-emerald-700">Laporan ini telah selesai ditangani. Tidak ada aksi lebih lanjut.</p>
            </div>

        @elseif ($report->status === 'ditolak')
            {{-- STATUS: ditolak → tampilkan info saja, tidak ada tombol ubah status --}}
            <div class="bg-rose-50 border border-rose-200 rounded-xl px-4 py-3 flex items-center gap-3">
                <i class="fa-solid fa-ban text-rose-500 text-lg"></i>
                <p class="text-sm font-semibold text-rose-700">Laporan ini telah ditolak. Tidak ada aksi lebih lanjut.</p>
            </div>
        @endif

        {{-- Tombol Hapus dari Sistem (tersedia di semua status) --}}
        <div class="pt-2 border-t border-slate-100">
            <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus laporan ini secara permanen dari sistem?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="w-full bg-white border border-red-200 text-red-500 hover:bg-red-50 font-bold py-3 rounded-xl transition text-sm">
                    <i class="fa-solid fa-trash mr-2"></i> Hapus dari Sistem
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
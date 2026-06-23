{{--
    Laporan Saya. Diadaptasi dari desain Naufal (FrontEnd).
    Variabel dari UserReportController@index:
    - $reports (Paginator of Report milik user yang login, with category & tags)

    PERBAIKAN dari kode asli Naufal:
    - Baris <tr> yang tadinya 1 hardcode ("Simulasi Looping Data") -> diganti @forelse asli
    - route(..., 1) hardcode -> route(..., $report) pakai Route Model Binding
    - REVISI FINAL: Menghilangkan fitur Edit dan Hapus, hanya mempertahankan tombol Detail.
    - DITAMBAHKAN: pagination & empty state
--}}
@extends('layouts.user')
@section('title', 'Laporan Saya - BISA')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto pb-12">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-black text-slate-900 mb-1 tracking-tight">Laporan Sampah</h2>
            <p class="text-gray-500 text-sm font-medium">Kelola dan pantau semua laporan sampah Anda</p>
        </div>
        <a href="{{ route('user.reports.create') }}"
           class="bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold px-5 py-2.5 rounded-lg shadow-sm transition text-sm cursor-pointer">
            + Buat Laporan
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600 min-w-[700px]">
                <thead class="bg-slate-50 border-b border-gray-200">
                    <tr>
                        <th class="p-5 font-bold text-slate-900 text-[13px] uppercase tracking-wider">Judul</th>
                        <th class="p-5 font-bold text-slate-900 text-[13px] uppercase tracking-wider">Jenis</th>
                        <th class="p-5 font-bold text-slate-900 text-[13px] uppercase tracking-wider">Status</th>
                        <th class="p-5 font-bold text-slate-900 text-[13px] uppercase tracking-wider">Tanggal</th>
                        <th class="p-5 font-bold text-slate-900 text-[13px] uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($reports as $report)
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
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="p-5">
                                <a href="{{ route('user.reports.show', $report) }}" class="font-bold text-slate-900 mb-1 text-base block hover:text-[#1a8e5f] transition">{{ $report->judul }}</a>
                                @if ($report->tags->isNotEmpty())
                                    <div class="flex flex-wrap gap-1.5 mt-1.5">
                                        @foreach ($report->tags as $tag)
                                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold px-2 py-0.5 rounded-full">#{{ $tag->nama_tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="p-5">
                                <div class="bg-slate-100 border border-gray-200 px-3 py-1.5 rounded text-xs font-bold text-slate-700 text-center w-max select-none">
                                    {{ $report->category->nama_kategori }}
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="{{ $statusStyle }} border px-3 py-1 rounded-full text-xs font-black select-none">{{ ucfirst($report->status) }}</span>
                            </td>
                            <td class="p-5 text-gray-500 font-medium text-xs">{{ $report->created_at->format('d M Y') }}</td>
                            <td class="p-5 text-right">
                                <a href="{{ route('user.reports.show', $report) }}" class="font-bold text-[#1a8e5f] hover:text-emerald-700 hover:underline text-sm cursor-pointer transition">Detail &rarr;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400 font-medium">
                                Anda belum membuat laporan apapun.
                                <a href="{{ route('user.reports.create') }}" class="text-[#1a8e5f] font-bold hover:underline ml-1">Buat laporan pertama Anda.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pt-2">
        {{ $reports->links() }}
    </div>
</div>
@endsection
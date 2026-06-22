{{--
    Data Laporan Warga (Admin). Variabel dari AdminReportController@index:
    - $reports (Paginator of Report, with user & category)
    - $categories (Collection of Category, untuk dropdown filter)
    - $filterStatus (string|null, nilai filter status aktif)
    - $filterCategory (string|null, nilai filter category_id aktif)

    PERBAIKAN dari kode Naufal:
    - 1 baris hardcode → @forelse loop asli
    - Tambah filter dropdown Status & Kategori
    - Tambah kolom Kategori & Tanggal
    - Tambah Pagination + withQueryString
    - route(..., 1) hardcode → route(..., $report)
    - Tambah hashtag tags di kolom Judul (improvisasi sesuai revisi user)
--}}
@extends('layouts.admin')
@section('title', 'Data Laporan Warga - BISA')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">

    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Manajemen Laporan Warga</h2>
            <p class="text-gray-500 text-sm mt-1">Validasi dan kelola seluruh laporan yang masuk</p>
        </div>
    </div>

    {{-- Filter Dropdown Status & Kategori --}}
    <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap gap-3">
        <select name="status" onchange="this.form.submit()"
            class="bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:border-[#1a8e5f] focus:ring-2 cursor-pointer">
            <option value="">Semua Status</option>
            <option value="menunggu" @selected($filterStatus === 'menunggu')>Menunggu Validasi</option>
            <option value="diproses" @selected($filterStatus === 'diproses')>Diproses</option>
            <option value="selesai"  @selected($filterStatus === 'selesai')>Selesai</option>
            <option value="ditolak"  @selected($filterStatus === 'ditolak')>Ditolak</option>
        </select>

        <select name="category" onchange="this.form.submit()"
            class="bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:border-[#1a8e5f] focus:ring-2 cursor-pointer">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) $filterCategory === $category->id)>
                    {{ $category->nama_kategori }}
                </option>
            @endforeach
        </select>

        @if ($filterStatus || $filterCategory)
            <a href="{{ route('admin.reports.index') }}"
               class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-4 py-2.5 rounded-xl text-sm transition">
                Reset Filter
            </a>
        @endif
    </form>

    {{-- Tabel Data Laporan --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Pelapor</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Judul Aduan</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($reports as $index => $report)
                    @php
                        $statusStyle = match ($report->status) {
                            'menunggu' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'selesai'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'ditolak'  => 'bg-rose-50 text-rose-700 border-rose-200',
                            default    => 'bg-slate-50 text-slate-700 border-slate-200',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-slate-500">{{ $reports->firstItem() + $index }}</td>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $report->user->name }}</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900">{{ $report->judul }}</p>
                            @if ($report->tags->isNotEmpty())
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach ($report->tags as $tag)
                                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full">#{{ $tag->nama_tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">{{ $report->category->nama_kategori }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ $statusStyle }} border px-3 py-1 rounded-full text-[11px] font-bold">{{ ucfirst($report->status) }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-xs font-medium">{{ $report->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.reports.show', $report) }}" class="font-bold text-[#1a8e5f] hover:underline text-xs">Periksa &rarr;</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400">Tidak ada laporan yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $reports->links() }}

</div>
@endsection
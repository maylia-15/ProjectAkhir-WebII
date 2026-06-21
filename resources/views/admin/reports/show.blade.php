@extends('layouts.admin')
@section('title', 'Validasi Laporan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    <a href="{{ route('admin.reports.index') }}" class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2"><i class="fa-solid fa-chevron-left text-xs"></i> Kembali</a>
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
        <h3 class="text-xl font-black text-slate-900 mb-4">Pohon Tumbang</h3>
        <p class="text-sm text-gray-600 mb-6">Pelapor: Muhammad Naufal Abdillah | Menunggu Validasi Admin</p>
        <div class="flex gap-4">
            <form action="{{ route('admin.reports.updateStatus', 1) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="bg-[#1a8e5f] text-white px-6 py-2 rounded-lg font-bold">Setujui & Proses</button>
            </form>
            <form action="{{ route('admin.reports.destroy', 1) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-50 text-red-600 px-6 py-2 rounded-lg font-bold border border-red-200">Hapus Laporan</button>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.user')
@section('title', 'Edit Laporan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    <a href="{{ route('user.reports.index') }}" class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2">
        <i class="fa-solid fa-chevron-left text-xs"></i> Kembali
    </a>
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        <h2 class="text-2xl font-black text-slate-900 mb-6">Edit Laporan</h2>
        <form action="{{ route('user.reports.update', 1) }}" method="POST" class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan</label>
                <input type="text" name="title" value="Tumpukan Sampah Plastik" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2">
            </div>
            <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm mt-4">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
@extends('layouts.user')
@section('title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    <div>
        <h2 class="text-3xl font-black text-slate-900 mb-1">Buat Laporan Baru</h2>
        <p class="text-[#1a8e5f] text-sm">Laporkan masalah sampah di area kompleks</p>
    </div>

    <form action="{{ route('user.reports.store') }}" method="POST" class="w-full bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan <span class="text-red-500">*</span></label>
            <input type="text" name="title" required placeholder="Contoh: Tumpukan Sampah Plastik di Dekat Taman" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2">
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea rows="4" name="description" required placeholder="Jelaskan detail masalah sampah..." class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2"></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Sampah <span class="text-red-500">*</span></label>
            <select name="category" required class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2">
                <option value="organik">Organik</option>
                <option value="anorganik">Anorganik</option>
                <option value="b3">B3 (Berbahaya)</option>
            </select>
        </div>
        <div class="flex gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('user.reports.index') }}" class="w-1/2 text-center bg-white border border-gray-300 text-slate-800 font-bold py-3.5 rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="w-1/2 bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm">Buat Laporan</button>
        </div>
    </form>
</div>
@endsection
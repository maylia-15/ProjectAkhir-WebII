@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-black text-slate-900">Pengumuman Kompleks</h2>
        <button class="bg-[#1a8e5f] text-white font-bold px-4 py-2 rounded-lg"><i class="fa-solid fa-plus mr-2"></i> Tambah Baru</button>
    </div>
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm mt-4">
        <p class="text-gray-500 text-sm">Daftar pengumuman aktif akan muncul di sini.</p>
    </div>
</div>
@endsection
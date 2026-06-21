@extends('layouts.user')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto pb-12">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        <h2 class="text-2xl font-black text-slate-900 mb-6">Profil Akun Saya</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="flex flex-col items-center mb-6">
                <div class="w-24 h-24 bg-[#1a8e5f] rounded-full flex items-center justify-center mb-4"><i class="fa-regular fa-user text-white text-4xl"></i></div>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="Muhammad Naufal Abdillah" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2">
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">Nomor HP</label>
                <input type="tel" name="phone" value="081234567890" class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2">
            </div>
            <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm mt-4">Simpan Perubahan Data</button>
        </form>
    </div>
</div>
@endsection
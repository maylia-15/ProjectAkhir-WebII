{{--
    Halaman Profil (R - Read saja). Variabel dari ProfileController@show:
    - $user (Auth::user())

    Sesuai konsep UI (revisi final): Halaman Profil terpisah dari Halaman Edit Profil.
    REVISI:
    - Menghapus informasi unit di bawah nama avatar untuk menghindari duplikasi.
    - Mengubah susunan tombol "Edit Profil" dan "Keluar" menjadi sejajar berdampingan (flex-row).
--}}
@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto pb-12">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">

        {{-- Area Avatar & Nama (Teks Unit di bawah nama sudah dihapus bersih) --}}
        <div class="flex flex-col items-center mb-6">
            <div class="w-24 h-24 bg-[#1a8e5f] rounded-full flex items-center justify-center mb-4 shadow-sm select-none">
                <i class="fa-regular fa-user text-white text-4xl"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h2>
        </div>

        {{-- Form Blok Informasi User (Read-Only) --}}
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1.5 select-none">Email</label>
                <p class="w-full bg-slate-50 border border-gray-200 rounded-lg p-3.5 text-slate-700 font-medium select-all">{{ $user->email }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1.5 select-none">Nomor HP</label>
                <p class="w-full bg-slate-50 border border-gray-200 rounded-lg p-3.5 text-slate-700 font-medium select-all">{{ $user->no_hp }}</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1.5 select-none">Unit (Blok/No. Rumah)</label>
                <p class="w-full bg-slate-50 border border-gray-200 rounded-lg p-3.5 text-slate-700 font-bold select-all">{{ $user->blok_rumah }}</p>
            </div>
        </div>

        {{-- Tombol Aksi Sejajar Berdampingan (Flexbox Row 50:50) --}}
        <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
            <a href="{{ route('profile.edit') }}"
               class="w-1/2 text-center bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm transition cursor-pointer text-sm">
                Edit Profil
            </a>

            <form action="{{ route('logout') }}" method="POST" class="w-1/2">
                @csrf
                <button type="submit"
                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 rounded-lg transition cursor-pointer text-sm">
                    Keluar
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
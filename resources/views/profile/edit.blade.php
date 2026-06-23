{{--
    Halaman Edit Profil. Diadaptasi dari desain Naufal (FrontEnd).
    Variabel dari ProfileController@edit:
    - $user (Auth::user())

    REVISI:
    - Mengubah tombol submit tunggal menjadi dua tombol berdampingan (Flexbox Row 50:50).
    - Menambahkan tombol 'Batal' di sebelah kiri tombol 'Simpan Perubahan' yang mengarah kembali ke profile.show.
--}}
@extends('layouts.user')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="max-w-2xl mx-auto pb-12">
    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        <h2 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Profil Akun Saya</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf 
            @method('PUT')

            {{-- Area Avatar Bulat --}}
            <div class="flex flex-col items-center mb-6">
                <div class="w-24 h-24 bg-[#1a8e5f] rounded-full flex items-center justify-center mb-4 shadow-sm select-none">
                    <i class="fa-regular fa-user text-white text-4xl"></i>
                </div>
            </div>

            {{-- Input Nama --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition font-medium">
                @error('name')
                    <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Email (Disabled) --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Email</label>
                <input type="email" value="{{ $user->email }}" disabled
                    class="w-full bg-slate-100 border border-gray-300 rounded-lg p-3.5 text-slate-500 font-medium cursor-not-allowed select-none">
                <p class="text-xs text-slate-400 mt-1.5 font-medium">Email tidak dapat diubah.</p>
            </div>

            {{-- Input Nomor HP --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Nomor HP</label>
                <input type="tel" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition font-medium">
                @error('no_hp')
                    <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Unit --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Unit (Blok/No. Rumah)</label>
                <input type="text" name="blok_rumah" value="{{ old('blok_rumah', $user->blok_rumah) }}"
                    placeholder="Contoh: Blok A No. 12"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition font-bold">
                @error('blok_rumah')
                    <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password Baru --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Password Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition placeholder:text-slate-400 text-sm">
                @error('password')
                    <p class="text-rose-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Konfirmasi Password Baru --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2 select-none">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition placeholder:text-slate-400 text-sm">
            </div>

            {{-- Tombol Aksi Sejajar Berdampingan (Flexbox Row Baru) --}}
            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-100">
                <!-- Kiri: Tombol Batal -->
                <a href="{{ route('profile.show') }}" 
                   class="w-1/2 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 rounded-lg transition cursor-pointer text-sm">
                    Batal
                </a>
                
                <!-- Kanan: Tombol Simpan Perubahan -->
                <button type="submit" class="w-1/2 bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm transition cursor-pointer text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
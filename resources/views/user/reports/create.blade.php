{{--
    Form Buat Laporan Baru. Diadaptasi dari desain Naufal (FrontEnd).
    Variabel dari UserReportController@create:
    - $categories (Collection of Category)
    - $tags (Collection of Tag: Bau Menyengat, Menumpuk, Berserakan)

    PERBAIKAN dari kode asli Naufal:
    - name="title" -> name="judul" (harus sama dengan StoreReportRequest)
    - name="description" -> name="deskripsi"
    - name="category" (value string slug) -> name="category_id" (value ID asli dari DB)
    - DITAMBAHKAN: field Lokasi (sebelumnya hilang total, padahal wajib diisi)
    - DITAMBAHKAN: checkbox Tags (sebelumnya hilang, sesuai kesepakatan tetap dipakai)

    JANGAN ubah name="..." pada setiap input/select/checkbox.
--}}
@extends('layouts.user')
@section('title', 'Buat Laporan Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    <div>
        <h2 class="text-3xl font-black text-slate-900 mb-1">Buat Laporan Baru</h2>
        <p class="text-[#1a8e5f] text-sm font-medium">Laporkan masalah sampah di area kompleks</p>
    </div>

    <form action="{{ route('user.reports.store') }}" method="POST" class="w-full bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan <span class="text-red-500">*</span></label>
            <input type="text" name="judul" required value="{{ old('judul') }}"
                placeholder="Contoh: Tumpukan Sampah Plastik di Dekat Taman"
                class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">
            @error('judul')
                <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea rows="4" name="deskripsi" required
                placeholder="Jelaskan detail masalah sampah..."
                class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Sampah <span class="text-red-500">*</span></label>
            <select name="category_id" required class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none cursor-pointer transition">
                <option value="">-- Pilih Jenis Sampah --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Lokasi <span class="text-red-500">*</span></label>
            <input type="text" name="lokasi" required value="{{ old('lokasi') }}"
                placeholder="Contoh: Dekat Taman Kompleks, Area Parkir Blok B, dll"
                class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">
            @error('lokasi')
                <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-900 mb-2">Tags (Pilih yang sesuai)</label>
            <div class="flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 bg-slate-50 border border-gray-300 rounded-lg px-4 py-2.5 cursor-pointer hover:border-[#1a8e5f] transition select-none">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            @checked(in_array($tag->id, old('tags', [])))
                            class="accent-[#1a8e5f] w-4 h-4 cursor-pointer">
                        <span class="text-sm font-medium text-slate-700">{{ $tag->nama_tag }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags')
                <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('user.reports.index') }}" class="w-1/2 text-center bg-white border border-gray-300 text-slate-800 font-bold py-3.5 rounded-lg hover:bg-gray-50 transition cursor-pointer">Batal</a>
            <button type="submit" class="w-1/2 bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm transition cursor-pointer">Buat Laporan</button>
        </div>
    </form>
</div>
@endsection
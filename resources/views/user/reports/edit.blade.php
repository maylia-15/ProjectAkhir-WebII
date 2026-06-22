{{--
    Form Edit Laporan. Diadaptasi dari desain Naufal (FrontEnd).
    Variabel dari UserReportController@edit:
    - $report (with tags, untuk pre-select checkbox tags lama)
    - $categories (Collection of Category)
    - $tags (Collection of Tag, semua opsi checkbox)

    PERBAIKAN dari kode asli Naufal:
    - Sebelumnya cuma ada 1 field (judul) -> DITAMBAHKAN Deskripsi, Jenis Sampah, Lokasi, Tags
      (sama lengkapnya dengan create.blade.php, plus pre-fill data lama)
    - name="title" -> name="judul"
    - route(..., 1) hardcode -> route(..., $report) pakai Route Model Binding
--}}
@extends('layouts.user')
@section('title', 'Edit Laporan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">
    <a href="{{ route('user.reports.show', $report) }}" class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2 w-max transition">
        <i class="fa-solid fa-chevron-left text-xs"></i> Kembali
    </a>

    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
        <h2 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Edit Laporan</h2>

        <form action="{{ route('user.reports.update', $report) }}" method="POST" class="space-y-6">
            @csrf 
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Judul Laporan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" required value="{{ old('judul', $report->judul) }}"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">
                @error('judul')
                    <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea rows="4" name="deskripsi" required
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">{{ old('deskripsi', $report->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Sampah <span class="text-red-500">*</span></label>
                <select name="category_id" required class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none cursor-pointer transition">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $report->category_id) == $category->id)>
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
                <input type="text" name="lokasi" required value="{{ old('lokasi', $report->lokasi) }}"
                    class="w-full bg-slate-50 border border-gray-300 rounded-lg p-3.5 focus:border-[#1a8e5f] focus:ring-2 outline-none transition">
                @error('lokasi')
                    <p class="text-rose-600 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            @php
                $tagTerpilih = old('tags', $report->tags->pluck('id')->toArray());
            @endphp
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Tags (Pilih yang sesuai)</label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($tags as $tag)
                        <label class="flex items-center gap-2 bg-slate-50 border border-gray-300 rounded-lg px-4 py-2.5 cursor-pointer hover:border-[#1a8e5f] transition select-none">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                @checked(in_array($tag->id, $tagTerpilih))
                                class="accent-[#1a8e5f] w-4 h-4 cursor-pointer">
                            <span class="text-sm font-medium text-slate-700">{{ $tag->nama_tag }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-sm mt-4 transition cursor-pointer">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
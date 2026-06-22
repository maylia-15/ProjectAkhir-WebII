{{--
    Data Warga (Admin, Read Only). Variabel dari WargaController@index:
    - $wargas (Paginator of User dengan role warga)
    - $search (string|null, nilai pencarian aktif)

    Sesuai konsep UI Admin (revisi):
    - Tabel: No | Nama | Blok/No. Rumah | No. HP | Email
    - Fitur search (cari nama, blok, no HP)
    - Card info (Total Terdaftar, Hasil Pencarian, Blok Aktif) DIHAPUS sesuai permintaan revisi

    PERBAIKAN dari kode Naufal:
    - 1 baris hardcode → @forelse loop asli
    - Kolom tidak lengkap (hanya No. HP & Nama) → lengkap 5 kolom
    - Tambah fitur search
    - Tambah pagination
--}}
@extends('layouts.admin')
@section('title', 'Data Warga - BISA')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Database Warga Terdaftar</h2>
            <p class="text-gray-500 text-sm mt-1">Daftar seluruh akun warga yang terdaftar di BISA</p>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.wargas.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari nama, blok, atau no HP..."
                class="bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-[#1a8e5f] focus:ring-2 w-64">
            <button type="submit"
                class="bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl transition text-sm">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            @if ($search)
                <a href="{{ route('admin.wargas.index') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-4 py-2.5 rounded-xl transition text-sm">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel Data Warga --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Blok / No. Rumah</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">No. HP</th>
                    <th class="px-6 py-4 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Email</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($wargas as $index => $warga)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-slate-500">{{ $wargas->firstItem() + $index }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900">{{ $warga->name }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $warga->blok_rumah }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $warga->no_hp }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $warga->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                            @if ($search)
                                Tidak ada warga yang cocok dengan pencarian "<strong>{{ $search }}</strong>".
                            @else
                                Belum ada warga terdaftar.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $wargas->links() }}

</div>
@endsection
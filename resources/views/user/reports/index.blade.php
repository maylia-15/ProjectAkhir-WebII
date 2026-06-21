@extends('layouts.user')
@section('title', 'Laporan Saya - BiSa')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto pb-12">
    <div>
        <h2 class="text-3xl font-black text-slate-900 mb-1">Laporan Sampah</h2>
        <p class="text-gray-500 text-sm">Kelola dan pantau semua laporan sampah Anda</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr>
                    <th class="p-5 font-bold text-slate-900">Judul</th>
                    <th class="p-5 font-bold text-slate-900">Jenis</th>
                    <th class="p-5 font-bold text-slate-900">Status</th>
                    <th class="p-5 font-bold text-slate-900">Tanggal</th>
                    <th class="p-5 font-bold text-slate-900 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Simulasi Looping Data -->
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-5"><p class="font-bold text-slate-900 mb-1 text-base">Tumpukan Sampah Plastik di Dekat Taman</p></td>
                    <td class="p-5"><div class="bg-slate-100 border border-gray-200 px-3 py-1.5 rounded text-xs font-semibold text-slate-700 text-center w-max">Anorganik</div></td>
                    <td class="p-5"><span class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-xs font-bold">Diproses</span></td>
                    <td class="p-5 text-gray-500 text-xs">15 Jun 2024</td>
                    <td class="p-5 text-right flex flex-col gap-2">
                        <a href="{{ route('user.reports.show', 1) }}" class="font-semibold text-[#1a8e5f] hover:underline text-sm">Detail &rarr;</a>
                        <a href="{{ route('user.reports.edit', 1) }}" class="font-semibold text-indigo-500 hover:underline text-sm">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
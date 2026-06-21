@extends('layouts.admin')
@section('title', 'Semua Laporan Warga')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">
    <h2 class="text-2xl font-black text-slate-900">Manajemen Laporan Warga</h2>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm mt-6">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr>
                    <th class="p-5 font-bold text-slate-900">Pelapor</th>
                    <th class="p-5 font-bold text-slate-900">Judul Aduan</th>
                    <th class="p-5 font-bold text-slate-900">Status</th>
                    <th class="p-5 font-bold text-slate-900 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="p-5 font-bold text-slate-900">Muhammad Naufal Abdillah</td>
                    <td class="p-5">Pohon Tumbang</td>
                    <td class="p-5"><span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Menunggu</span></td>
                    <td class="p-5 text-right"><a href="{{ route('admin.reports.show', 1) }}" class="font-bold text-[#1a8e5f] hover:underline">Periksa &rarr;</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
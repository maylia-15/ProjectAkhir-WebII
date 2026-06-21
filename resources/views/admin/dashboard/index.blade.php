@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">
    <h2 class="text-2xl font-black text-slate-900">Dashboard Statistik</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mt-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 font-medium mb-4">Total Menunggu Validasi</p>
            <p class="text-3xl font-black text-slate-900">5</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 font-medium mb-4">Sedang Diproses</p>
            <p class="text-3xl font-black text-slate-900">2</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs text-gray-500 font-medium mb-4">Laporan Selesai</p>
            <p class="text-3xl font-black text-slate-900">120</p>
        </div>
    </div>
</div>
@endsection
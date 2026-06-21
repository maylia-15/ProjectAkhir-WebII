@extends('layouts.user')
@section('title', 'Detail Laporan')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto pb-12">
    <a href="{{ route('user.reports.index') }}" class="text-slate-600 hover:text-[#1a8e5f] font-bold text-sm flex items-center gap-2">
        <i class="fa-solid fa-chevron-left text-xs"></i> Kembali ke Daftar Laporan
    </a>
    
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-6">
        <div class="border-b border-gray-100 pb-4">
            <span class="bg-indigo-50 text-indigo-700 border border-indigo-200 px-3 py-1 rounded-full text-xs font-bold">Diproses</span>
            <h3 class="text-2xl font-black text-slate-900 mt-4">Tumpukan Sampah Plastik di Dekat Taman</h3>
        </div>
        <div class="pt-2 space-y-4">
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 border-l-4 border-[#1a8e5f] pl-2">Pelacakan Laporan</h4>
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 bg-indigo-500 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-md">
                    <i class="fa-solid fa-truck-moving"></i>
                </div>
                <div class="bg-slate-50 border border-gray-200 p-4 rounded-xl flex-1">
                    <p class="text-sm font-bold text-indigo-600 mb-1">Sedang Diproses Petugas</p>
                    <p class="text-xs text-slate-700 font-medium">15 Jun 2024, 09:30 - Armada kebersihan sedang menuju lokasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
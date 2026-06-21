@extends('layouts.admin')
@section('title', 'Data Warga')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 pb-12">
    <h2 class="text-2xl font-black text-slate-900">Database Warga Terdaftar</h2>
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm mt-6">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-slate-50 border-b border-gray-200">
                <tr><th class="p-5 font-bold text-slate-900">No. HP</th><th class="p-5 font-bold text-slate-900">Nama</th></tr>
            </thead>
            <tbody>
                <tr><td class="p-5">081234567890</td><td class="p-5 font-bold text-slate-900">Muhammad Naufal Abdillah</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
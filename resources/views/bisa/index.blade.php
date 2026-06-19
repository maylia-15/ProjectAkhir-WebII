@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 pb-24">

    @include('bisa.partials.beranda')
    @include('bisa.partials.pengaduan')
    @include('bisa.partials.lacak')
    @include('bisa.partials.komunitas')

</div>

<nav class="fixed bottom-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-50">
    <div class="max-w-7xl mx-auto flex justify-around items-center py-2">
        <button onclick="switchTab('beranda', this)" class="nav-btn text-emerald-600 flex flex-col items-center w-1/4 py-2">
            <i class="fa-solid fa-house text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Beranda</span>
        </button>
        <button onclick="switchTab('pengaduan', this)" class="nav-btn text-gray-400 hover:text-emerald-600 flex flex-col items-center w-1/4 py-2">
            <i class="fa-regular fa-comment-dots text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Pengaduan</span>
        </button>
        <button onclick="switchTab('lacak', this)" class="nav-btn text-gray-400 hover:text-emerald-600 flex flex-col items-center w-1/4 py-2">
            <i class="fa-regular fa-clock text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Lacak</span>
        </button>
        <button onclick="switchTab('komunitas', this)" class="nav-btn text-gray-400 hover:text-emerald-600 flex flex-col items-center w-1/4 py-2">
            <i class="fa-solid fa-user-group text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Komunitas</span>
        </button>
    </div>
</nav>
@endsection
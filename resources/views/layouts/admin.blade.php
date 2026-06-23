<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BISA - Admin')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased">
<div class="flex h-screen w-screen overflow-hidden">

    {{--
        SIDEBAR DESKTOP (selalu terbuka statis, TIDAK ada tombol toggle sesuai konsep UI Admin).
        Berbeda dengan User yang bisa collapse, Admin sidebar FIXED OPEN di desktop.
    --}}
    <aside class="hidden md:flex flex-col justify-between w-64 bg-white border-r border-gray-200 h-full shrink-0 z-20 shadow-sm">
        <div>
            {{-- Logo --}}
            <div class="px-6 py-8 flex items-center gap-3 border-b border-slate-100">
                <div class="w-8 h-8 bg-slate-800 rounded flex items-center justify-center text-white font-black text-lg">B</div>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 tracking-wide leading-none">BISA</h1>
                    <span class="text-[10px] text-red-500 font-bold uppercase tracking-wider">Admin Panel</span>
                </div>
            </div>

            {{-- Navigasi --}}
            <nav class="p-4 space-y-2 mt-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm
                   {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
                </a>
                <a href="{{ route('admin.reports.index') }}"
                   class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm
                   {{ request()->is('admin/laporan*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                    <i class="fa-solid fa-inbox w-5 text-center"></i> Data Laporan
                </a>
                <a href="{{ route('admin.announcements.index') }}"
                   class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm
                   {{ request()->is('admin/pengumuman*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                    <i class="fa-solid fa-bullhorn w-5 text-center"></i> Kelola Pengumuman
                </a>
                <a href="{{ route('admin.wargas.index') }}"
                   class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm
                   {{ request()->is('admin/warga*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                    <i class="fa-solid fa-users w-5 text-center"></i> Data Warga
                </a>
            </nav>
        </div>

        {{--
            Kartu Profil Admin di bawah sidebar.
            Sesuai konsep UI Admin: klik titik tiga → popup kecil melayang ke atas berisi HANYA tombol Keluar.
            (Berbeda dengan User yang punya 2 tombol Profil+Keluar langsung)
        --}}
        <div class="p-4 mt-auto border-t border-slate-100 relative">

            {{-- Popup Keluar (tersembunyi default, muncul saat titik tiga diklik) --}}
            <div id="admin-profile-dropdown"
                 class="hidden absolute bottom-full left-4 right-4 mb-3 bg-white border border-slate-200 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.12)] overflow-hidden z-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-5 py-4 flex items-center gap-3 hover:bg-rose-50 text-sm font-semibold text-rose-600 transition cursor-pointer">
                        <i class="fa-solid fa-door-open text-rose-500 w-5 text-center"></i> Keluar
                    </button>
                </form>
            </div>

            {{-- Kartu Profil --}}
            <div id="admin-profile-btn"
                 class="bg-gray-50 border border-gray-200 p-3 rounded-2xl flex items-center justify-between cursor-pointer hover:bg-gray-100 transition shadow-sm select-none">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Admin</p>
                    </div>
                </div>
                <i class="fa-solid fa-ellipsis-vertical text-gray-400 pr-1"></i>
            </div>
        </div>
    </aside>

    {{-- DRAWER MOBILE ADMIN --}}
    <div id="mobile-drawer" class="hidden fixed inset-0 z-50 md:hidden">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeMobileDrawer()"></div>
        <div class="fixed inset-y-0 left-0 w-64 bg-white flex flex-col justify-between h-full shadow-2xl">
            <div>
                <div class="px-6 py-6 flex items-center justify-between border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-800 rounded flex items-center justify-center text-white font-bold">B</div>
                        <span class="font-bold text-slate-900 text-xl">BISA</span>
                    </div>
                    <button onclick="closeMobileDrawer()" class="text-gray-400 cursor-pointer"><i class="fa-solid fa-xmark text-xl"></i></button>
                </div>
                <nav class="p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-chart-pie w-5"></i> Dashboard</a>
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/laporan*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-inbox w-5"></i> Data Laporan</a>
                    <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/pengumuman*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-bullhorn w-5"></i> Kelola Pengumuman</a>
                    <a href="{{ route('admin.wargas.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/warga*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-users w-5"></i> Data Warga</a>
                </nav>
            </div>
            <div class="p-4 border-t border-slate-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-red-50 text-red-600 font-bold rounded-xl text-sm hover:bg-red-100 cursor-pointer">
                        <i class="fa-solid fa-door-open"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        {{-- Header Mobile --}}
        <header class="md:hidden w-full bg-white border-b border-gray-200 py-4 px-5 flex items-center justify-between shrink-0 z-10">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 bg-slate-800 rounded-lg flex items-center justify-center text-white"><i class="fa-solid fa-user-shield text-xs"></i></div>
                <span class="font-bold text-slate-900">BISA Admin</span>
            </div>
            <button onclick="openMobileDrawer()" class="p-1.5 text-slate-700 border border-gray-200 rounded-lg cursor-pointer"><i class="fa-solid fa-bars text-lg"></i></button>
        </header>

        <main class="flex-1 overflow-y-auto p-6 md:p-10 scroll-smooth bg-[#F8FAFC]">
            {{-- Flash message sukses --}}
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold px-4 py-3 rounded-xl">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 text-sm px-4 py-3 rounded-xl">
                    <p class="font-bold mb-1"><i class="fa-solid fa-circle-exclamation mr-2"></i>Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script>
    // Drawer Mobile
    function openMobileDrawer() {
        document.getElementById('mobile-drawer').classList.remove('hidden');
    }
    function closeMobileDrawer() {
        document.getElementById('mobile-drawer').classList.add('hidden');
    }

    // Popup titik tiga Kartu Profil Admin (Keluar saja)
    const adminProfileBtn = document.getElementById('admin-profile-btn');
    const adminProfileDropdown = document.getElementById('admin-profile-dropdown');

    if (adminProfileBtn) {
        adminProfileBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            adminProfileDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', function () {
            adminProfileDropdown.classList.add('hidden');
        });
    }
</script>
</body>
</html>
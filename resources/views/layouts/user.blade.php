<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BiSa - Warga Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased h-screen w-screen overflow-hidden">
    <div class="flex h-full w-full overflow-hidden">
        
        <aside id="sidebar" class="hidden md:flex flex-col justify-between w-64 bg-white border-r border-slate-200 h-full shrink-0 z-20 shadow-sm ml-0">
            <div>
                <div class="px-7 py-8 flex items-center justify-between border-b border-slate-100/50">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#1a8e5f] rounded-xl flex items-center justify-center text-white font-black text-lg shadow-md shadow-emerald-500/20">B</div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">BiSa</h1>
                    </div>
                    <button onclick="toggleSidebar()" class="text-slate-400 hover:text-[#1a8e5f] transition-colors p-1.5 rounded-lg hover:bg-slate-50 outline-none cursor-pointer">
                        <i class="fa-solid fa-bars-staggered text-lg"></i>
                    </button>
                </div>
                
                <nav class="px-4 space-y-1.5 mt-4">
                    <a href="{{ route('user.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('user/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold shadow-[inset_0_0_0_1px_rgba(26,142,95,0.15)]' : 'text-slate-500 hover:text-[#1a8e5f] hover:bg-emerald-50/50' }}">
                        <i class="fa-solid fa-chart-column w-5 text-center"></i> Dashboard
                    </a>
                    <a href="{{ route('user.reports.index') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('user/laporan') || request()->is('user/laporan/*/edit') || (request()->is('user/laporan/*') && !request()->is('user/laporan/buat')) ? 'bg-emerald-50 text-[#1a8e5f] font-bold shadow-[inset_0_0_0_1px_rgba(26,142,95,0.15)]' : 'text-slate-500 hover:text-[#1a8e5f] hover:bg-emerald-50/50' }}">
                        <i class="fa-solid fa-clipboard-list w-5 text-center"></i> Laporan Saya
                    </a>
                    <a href="{{ route('user.reports.create') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('user/laporan/buat') ? 'bg-emerald-50 text-[#1a8e5f] font-bold shadow-[inset_0_0_0_1px_rgba(26,142,95,0.15)]' : 'text-slate-500 hover:text-[#1a8e5f] hover:bg-emerald-50/50' }}">
                        <i class="fa-solid fa-pen w-5 text-center"></i> Buat Laporan
                    </a>
                </nav>
            </div>
            
            <div class="p-4 relative mt-auto border-t border-slate-100">
                <div id="profile-dropdown" class="hidden absolute bottom-full left-4 right-4 mb-3 bg-white border border-slate-200 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] overflow-hidden z-50">
                    <a href="{{ route('profile.edit') }}" class="w-full text-left px-5 py-4 flex items-center gap-3 hover:bg-slate-50 text-sm font-semibold text-slate-700 border-b border-slate-100 transition">
                        <i class="fa-solid fa-circle-user text-[#1a8e5f] w-5 text-center text-lg"></i> Lihat Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-5 py-4 flex items-center gap-3 hover:bg-rose-50 text-sm font-semibold text-rose-600 transition cursor-pointer">
                            <i class="fa-solid fa-door-open text-rose-500 w-5 text-center text-lg"></i> Keluar
                        </button>
                    </form>
                </div>
                
                <div id="profile-menu-btn" class="bg-white border border-slate-200 p-3 rounded-2xl flex items-center justify-between cursor-pointer hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#1a8e5f] to-[#10b981] rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">A</div>
                        <div class="leading-tight">
                            <p class="text-sm font-bold text-slate-800">Ahmad Wijaya</p>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Unit A-101</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-ellipsis-vertical text-slate-400 pr-1"></i>
                </div>
            </div>
        </aside>

        <div id="mobile-drawer" class="hidden fixed inset-0 z-50 md:hidden">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeMobileDrawer()"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white flex flex-col justify-between h-full shadow-2xl">
                <div>
                    <div class="px-6 py-6 flex items-center justify-between border-b border-slate-100">
                        <div class="flex items-center gap-3"><div class="w-8 h-8 bg-[#1a8e5f] rounded-lg flex items-center justify-center text-white font-bold">B</div><span class="font-bold text-slate-900 text-xl">BiSa</span></div>
                        <button onclick="closeMobileDrawer()" class="text-slate-400 p-1.5"><i class="fa-solid fa-xmark text-xl"></i></button>
                    </div>
                    <nav class="p-4 space-y-1.5">
                        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('user/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-slate-500' }}"><i class="fa-solid fa-chart-column w-5"></i> Dashboard</a>
                        <a href="{{ route('user.reports.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('user/laporan*') && !request()->is('user/laporan/buat') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-slate-500' }}"><i class="fa-solid fa-clipboard-list w-5"></i> Laporan Saya</a>
                        <a href="{{ route('user.reports.create') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('user/laporan/buat') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-slate-500' }}"><i class="fa-solid fa-pen w-5"></i> Buat Laporan</a>
                    </nav>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-rose-50 text-rose-600 font-bold rounded-xl text-sm hover:bg-rose-100"><i class="fa-solid fa-door-open"></i> Keluar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            <header class="md:hidden w-full bg-white border-b border-slate-200 py-4 px-5 flex items-center justify-between shrink-0 z-10">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-[#1a8e5f] rounded-lg flex items-center justify-center text-white shadow-xs"><i class="fa-solid fa-leaf text-xs"></i></div>
                    <span class="font-bold text-slate-900 tracking-tight text-lg">BiSa Warga</span>
                </div>
                <button onclick="openMobileDrawer()" class="p-1.5 text-slate-500 border border-slate-200 rounded-lg bg-slate-50 cursor-pointer"><i class="fa-solid fa-bars text-lg"></i></button>
            </header>
            
            <main class="flex-1 overflow-y-auto p-6 md:p-10 relative scroll-smooth bg-[#F8FAFC]">
                <div class="mb-6 block">
                    <button id="open-sidebar-btn" onclick="toggleSidebar()" class="hidden items-center gap-2 text-slate-600 hover:text-[#1a8e5f] bg-white border border-slate-200 px-4 py-2.5 rounded-xl shadow-sm transition outline-none cursor-pointer">
                        <i class="fa-solid fa-bars text-lg"></i> <span class="font-bold text-sm">Menu</span>
                    </button>
                </div>
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
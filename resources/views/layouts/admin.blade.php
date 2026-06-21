<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BiSa - Admin')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased">
    <div class="flex h-screen w-screen overflow-hidden">
        
        <aside id="sidebar" class="hidden md:flex flex-col justify-between w-64 bg-white border-r border-gray-200 h-full shrink-0 z-20 transition-all duration-300">
            <div>
                <div class="px-6 py-8 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-800 rounded flex items-center justify-center text-white font-black text-lg">B</div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 tracking-wide leading-none">BiSa</h1>
                            <span class="text-[10px] text-red-500 font-bold uppercase">Admin Panel</span>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="text-gray-400 hover:text-slate-800"><i class="fa-solid fa-bars-staggered"></i></button>
                </div>
                
                <nav class="p-4 space-y-2 mt-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                        <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('admin/laporan*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                        <i class="fa-solid fa-inbox w-5 text-center"></i> Data Laporan
                    </a>
                    <a href="{{ route('admin.announcements.index') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('admin/pengumuman*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                        <i class="fa-solid fa-bullhorn w-5 text-center"></i> Pengumuman
                    </a>
                    <a href="{{ route('admin.wargas.index') }}" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl transition font-medium text-sm {{ request()->is('admin/warga*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold border border-emerald-100 shadow-sm' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i> Data Warga
                    </a>
                </nav>
            </div>
            
            <div class="p-4 relative mt-auto">
                <div id="profile-dropdown" class="hidden absolute bottom-full left-4 right-4 mb-2 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden z-50">
                    <a href="{{ route('profile.edit') }}" class="w-full text-left px-4 py-3.5 flex items-center gap-3 hover:bg-gray-50 text-sm font-semibold text-slate-700 border-b border-gray-100"><i class="fa-solid fa-circle-user text-slate-800 w-5 text-center"></i> Profil Admin</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3.5 flex items-center gap-3 hover:bg-red-50 text-sm font-semibold text-red-600"><i class="fa-solid fa-door-open text-red-500 w-5 text-center"></i> Keluar</button>
                    </form>
                </div>
                <div id="profile-menu-btn" class="bg-gray-50 border border-gray-200 p-2.5 rounded-xl flex items-center justify-between cursor-pointer hover:bg-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center text-white text-sm font-bold">A</div>
                        <div class="leading-tight"><p class="text-sm font-bold text-slate-900">Admin Utama</p><p class="text-[11px] text-slate-500 font-semibold mt-0.5">Admin</p></div>
                    </div>
                    <i class="fa-solid fa-ellipsis-vertical text-gray-400 pr-2"></i>
                </div>
            </div>
        </aside>

        <!-- DRAWER HP ADMIN -->
        <div id="mobile-drawer" class="hidden fixed inset-0 z-50 md:hidden">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeMobileDrawer()"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white flex flex-col justify-between h-full shadow-2xl">
                <div>
                    <div class="px-6 py-6 flex items-center justify-between border-b border-gray-100">
                        <div class="flex items-center gap-3"><div class="w-8 h-8 bg-slate-800 rounded flex items-center justify-center text-white font-bold">B</div><span class="font-bold text-slate-900 text-xl">BiSa</span></div>
                        <button onclick="closeMobileDrawer()" class="text-gray-400"><i class="fa-solid fa-xmark text-xl"></i></button>
                    </div>
                    <nav class="p-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-chart-pie w-5"></i> Dashboard</a>
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/laporan*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-inbox w-5"></i> Data Laporan</a>
                        <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/pengumuman*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-bullhorn w-5"></i> Pengumuman</a>
                        <a href="{{ route('admin.wargas.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl {{ request()->is('admin/warga*') ? 'bg-emerald-50 text-[#1a8e5f] font-bold' : 'text-gray-500 hover:text-[#1a8e5f] hover:bg-emerald-50' }}"><i class="fa-solid fa-users w-5"></i> Data Warga</a>
                    </nav>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-red-50 text-red-600 font-bold rounded-xl text-sm hover:bg-red-100"><i class="fa-solid fa-door-open"></i> Keluar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            <header class="md:hidden w-full bg-white border-b border-gray-200 py-4 px-5 flex items-center justify-between shrink-0 z-10">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 bg-slate-800 rounded-lg flex items-center justify-center text-white shadow-xs"><i class="fa-solid fa-user-shield text-xs"></i></div>
                    <span class="font-bold text-slate-900">BiSa Admin</span>
                </div>
                <button onclick="openMobileDrawer()" class="p-1.5 text-slate-700 border border-gray-200 rounded-lg"><i class="fa-solid fa-bars text-lg"></i></button>
            </header>
            <main class="flex-1 overflow-y-auto p-6 md:p-10 relative scroll-smooth bg-[#F8FAFC]">
                <button id="open-sidebar-btn" onclick="toggleSidebar()" class="hidden mb-6 flex items-center gap-2 text-gray-500 hover:text-[#1a8e5f] bg-white border border-gray-200 px-3 py-2.5 rounded-lg shadow-sm">
                    <i class="fa-solid fa-bars text-lg"></i> Menu
                </button>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
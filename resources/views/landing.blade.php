{{--
    Landing Page (Akses Publik). Variabel dari LandingController@index:
    - $totalLaporanSelesai (int, jumlah laporan dengan status "selesai")

    Sesuai konsep UI (revisi final): HANYA 1 SECTION/PANEL SAJA.
    Komponen: Judul aplikasi, jargon, fitur utama, statistik ringkas (dari DB),
    tombol "Masuk ke Aplikasi" -> Halaman Login.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiSa - Bersih itu Sama-sama</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFAFA] font-sans antialiased">

    <header class="w-full px-6 py-6 flex justify-between items-center max-w-6xl mx-auto">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-[#006D44] rounded flex items-center justify-center text-white font-bold text-sm">B</div>
            <span class="font-bold text-slate-900 text-lg">BiSa</span>
        </div>
        <a href="{{ route('login') }}" class="bg-[#006D44] hover:bg-[#005233] text-white text-[13px] font-bold px-6 py-2.5 rounded-lg transition shadow-sm">
            Masuk
        </a>
    </header>

    <main class="max-w-[225] mx-auto px-6 pt-12 pb-24 flex flex-col items-center">
        
        <h1 class="text-[36px] md:text-[44px] font-extrabold text-slate-900 text-center leading-[1.2] mb-5 tracking-tight">
            Bersih Bersama untuk<br>Komunitas yang Lebih Baik
        </h1>
        <p class="text-slate-500 text-center max-w-2xl text-[15px] leading-relaxed mb-14">
            Platform manajemen sampah cerdas untuk kompleks perumahan. Laporkan masalah sampah, pantau progres, dan bangun komunitas yang lebih bersih bersama-sama.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-14 max-w-[212.5]">
            <div class="bg-white rounded-xl shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-slate-100 p-7 flex flex-col items-start text-left">
                <div class="text-[32px] mb-3">📝</div>
                <h3 class="text-[15px] font-bold text-slate-900 mb-2">Laporan Mudah</h3>
                <p class="text-[13px] text-slate-500 leading-relaxed">Buat laporan sampah dengan cepat dan mudah hanya dalam beberapa klik</p>
            </div>
            <div class="bg-white rounded-xl shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-slate-100 p-7 flex flex-col items-start text-left">
                <div class="text-[32px] mb-3">📊</div>
                <h3 class="text-[15px] font-bold text-slate-900 mb-2">Pantau Progres</h3>
                <p class="text-[13px] text-slate-500 leading-relaxed">Lacak status laporan Anda secara real-time dengan sistem Menunggu &rarr; Diproses &rarr; Selesai</p>
            </div>
            <div class="bg-white rounded-xl shadow-[0_2px_15px_rgba(0,0,0,0.04)] border border-slate-100 p-7 flex flex-col items-start text-left">
                <div class="text-[32px] mb-3">📢</div>
                <h3 class="text-[15px] font-bold text-slate-900 mb-2">Komunikasi Transparan</h3>
                <p class="text-[13px] text-slate-500 leading-relaxed">Dapatkan update pengumuman terbaru dan informasi penting untuk komunitas</p>
            </div>
        </div>

        <div class="w-full max-w-[200] bg-[#F0FDF4] border border-[#C3E8D1] rounded-xl p-8 mb-12 shadow-sm">
            <h3 class="text-center text-[#006D44] font-bold text-[16px] mb-8">Statistik Laporan Sukses Diatasi</h3>
            <div class="grid grid-cols-4 gap-4 text-center">
                <div class="flex flex-col items-center">
                    <span class="text-[32px] font-black text-[#006D44] mb-1">4</span>
                    <span class="text-[12px] text-slate-500 font-medium">Total Laporan</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-[32px] font-black text-[#27AE60] mb-1">{{ $totalLaporanSelesai ?? '2' }}</span>
                    <span class="text-[12px] text-slate-500 font-medium">Telah Selesai</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-[32px] font-black text-[#2D9CDB] mb-1">1</span>
                    <span class="text-[12px] text-slate-500 font-medium">Diproses</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-[32px] font-black text-[#F2994A] mb-1">1</span>
                    <span class="text-[12px] text-slate-500 font-medium">Menunggu</span>
                </div>
            </div>
        </div>

        <a href="{{ route('login') }}" class="bg-[#006D44] hover:bg-[#005233] text-white font-bold text-[14px] px-8 py-3.5 rounded-lg shadow-sm transition">
            Masuk ke Aplikasi
        </a>

    </main>

</body>
</html>
{{--
    Landing Page (Akses Publik). Variabel dari LandingController@index:
    - $totalLaporanSelesai (int, jumlah laporan dengan status "selesai")

    Sesuai konsep UI (revisi final): HANYA 1 SECTION/PANEL SAJA.
    Komponen: Judul aplikasi, jargon, fitur utama, statistik ringkas (dari DB),
    tombol "Masuk ke Aplikasi" -> Halaman Login.

    REVISI AKURASI VISUAL KEDUA (ZOOM 100% PROPORSIONAL):
    - Mengubah kontainer menjadi justify-center agar ruang kosong bawah tombol hilang & seimbang.
    - Menaikkan skala ukuran komponen (Logo, Judul, Deskripsi, Card) satu tingkat lebih tegas.
    - Menjaga konsistensi logika rute tanpa ada pengurangan fungsi.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BISA - Bersih itu Sama-sama</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] font-sans antialiased min-h-screen flex flex-col">

    <header class="w-full bg-white border-b border-slate-200/80 px-6 py-4 flex items-center justify-between shrink-0 shadow-xs">
        <div class="flex items-center gap-2.5 select-none">
            <div class="w-8 h-8 bg-[#1a8e5f] rounded-lg flex items-center justify-center text-white font-black text-sm shadow-sm shadow-emerald-500/10">B</div>
            <span class="font-bold text-slate-900 tracking-tight text-lg">BISA</span>
        </div>
        <a href="{{ route('login') }}" 
           class="text-sm font-bold text-[#1a8e5f] hover:bg-emerald-50 border border-emerald-100 px-4 py-2 rounded-xl transition cursor-pointer">
            Masuk
        </a>
    </header>

    <div class="flex-1 flex flex-col items-center justify-center px-6 py-12">

        {{-- Logo Ikon Aplikasi (Ukuran w-14 h-14 yang pas) --}}
        <div class="w-14 h-14 bg-[#1a8e5f] rounded-2xl flex items-center justify-center mb-5 shadow-sm shadow-emerald-600/10">
            <i class="fa-solid fa-leaf text-white text-2xl"></i>
        </div>

        {{-- Judul Utama Web (Ukuran dinaikkan ke text-4xl md:text-5xl) --}}
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-3 text-center tracking-tight">BISA</h1>
        
        {{-- Deskripsi Aplikasi (Dinaikkan sedikit ke max-w-lg dan text-base) --}}
        <p class="text-slate-600 text-center max-w-lg mb-10 md:mb-12 text-sm md:text-base font-semibold leading-relaxed">
            Bersihkan Sampah Sama-sama. Lapor masalah sampah di area komplek Anda,
            pantau prosesnya, dan wujudkan lingkungan yang lebih bersih bersama warga lain.
        </p>

        {{-- Fitur-Fitur Utama Card Grid (Lebar maksimal disesuaikan ke max-w-4xl) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-4xl w-full mb-10 md:mb-12">
            
            <div class="bg-white rounded-2xl shadow-xs p-6 text-center border border-slate-200/60 flex flex-col items-center justify-center hover:shadow-md hover:border-emerald-200 transition duration-300">
                <i class="fa-solid fa-pen-to-square text-[#1a8e5f] text-2xl md:text-3xl mb-3"></i>
                <p class="text-base font-bold text-slate-900 mb-1">Lapor Mudah</p>
                <p class="text-xs md:text-sm text-slate-500 font-medium leading-relaxed">Buat laporan masalah sampah dalam hitungan detik</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xs p-6 text-center border border-slate-200/60 flex flex-col items-center justify-center hover:shadow-md hover:border-emerald-200 transition duration-300">
                <i class="fa-solid fa-location-dot text-[#1a8e5f] text-2xl md:text-3xl mb-3"></i>
                <p class="text-base font-bold text-slate-900 mb-1">Lacak Status</p>
                <p class="text-xs md:text-sm text-slate-500 font-medium leading-relaxed">Pantau progres penanganan laporan secara real-time</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xs p-6 text-center border border-slate-200/60 flex flex-col items-center justify-center hover:shadow-md hover:border-emerald-200 transition duration-300">
                <i class="fa-solid fa-users text-[#1a8e5f] text-2xl md:text-3xl mb-3"></i>
                <p class="text-base font-bold text-slate-900 mb-1">Gotong Royong</p>
                <p class="text-xs md:text-sm text-slate-500 font-medium leading-relaxed">Kolaborasi harmonis antar warga & pengurus komplek</p>
            </div>
            
        </div>

        {{-- Tombol Utama Masuk ke Aplikasi (Mantap dan proporsional) --}}
        <a href="{{ route('login') }}"
           class="bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-md shadow-emerald-700/5 transition cursor-pointer text-sm md:text-base tracking-wide select-none">
            Masuk ke Aplikasi
        </a>

    </div>

</body>
</html>
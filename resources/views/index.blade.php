@extends('layouts.app')

@section('content')
    <section id="beranda" class="tab-content active space-y-4">
        <div class="grad-green text-white p-4 rounded-xl shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="bg-red-500 text-xs font-bold px-2 py-1 rounded-full"><i class="fa-solid fa-bullhorn mr-1"></i> Pengumuman</span>
                <span class="text-xs">Hari ini</span>
            </div>
            <h2 class="font-bold">Kerja Bakti RT 04</h2>
            <p class="text-sm mt-1 opacity-90">Minggu, 08:00 WITA. Mari bersihkan selokan dari sampah plastik!</p>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="bg-green-100 text-green-600 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Laporan Bulan Ini</p>
                    <p class="font-bold text-lg text-gray-800">24</p>
                </div>
            </div>
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-check-double"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Selesai Ditangani</p>
                    <p class="font-bold text-lg text-gray-800">18</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <h3 class="font-bold text-gray-800 mb-3 border-b pb-2">Edukasi & Update</h3>
            <ul class="space-y-3">
                <li class="flex gap-3 items-start">
                    <div class="bg-orange-100 text-orange-600 p-2 rounded-lg"><i class="fa-solid fa-leaf"></i></div>
                    <div>
                        <h4 class="text-sm font-semibold">Cara Memilah Sampah Organik</h4>
                        <p class="text-xs text-gray-500">Tips memisahkan sisa makanan untuk kompos.</p>
                    </div>
                </li>
                <li class="flex gap-3 items-start">
                    <div class="bg-teal-100 text-teal-600 p-2 rounded-lg"><i class="fa-solid fa-recycle"></i></div>
                    <div>
                        <h4 class="text-sm font-semibold">Manfaat Daur Ulang Plastik</h4>
                        <p class="text-xs text-gray-500">Ubah botol bekas menjadi barang berguna.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="pengaduan" class="tab-content space-y-4">
        <h2 class="text-xl font-bold text-grad-green border-b pb-2">Buat Laporan Baru</h2>
        
        <form action="#" method="POST" class="space-y-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            @csrf <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Unggah Foto Sampah</label>
                <div class="border-2 border-dashed border-green-300 rounded-lg p-6 text-center bg-green-50 cursor-pointer">
                    <i class="fa-solid fa-camera text-3xl text-green-400 mb-2"></i>
                    <p class="text-xs text-gray-500">Klik untuk upload foto</p>
                    <input type="file" name="foto_sampah" class="hidden">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="liar">Sampah Liar</option>
                        <option value="rumah_tangga">Rumah Tangga</option>
                        <option value="besar">Sampah Besar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penanganan</label>
                    <select name="penanganan" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="angkut">Minta Diangkut</option>
                        <option value="kerja_bakti">Kerja Bakti</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="2" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Sampah numpuk di depan gang..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                <div class="flex gap-2">
                    <input type="text" name="lokasi" value="Jl. Brigjen Hasan Basri..." class="w-full border border-gray-300 rounded-lg p-2 text-sm bg-gray-50" readonly>
                    <button type="button" class="bg-blue-500 text-white px-3 rounded-lg"><i class="fa-solid fa-location-crosshairs"></i></button>
                </div>
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="w-2/3 grad-green text-white font-bold py-3 rounded-lg shadow-md hover:opacity-90">Kirim Aduan</button>
                <button type="button" class="w-1/3 bg-red-600 text-white font-bold py-3 rounded-lg shadow-md hover:bg-red-700 text-sm">
                    <i class="fa-solid fa-triangle-exclamation block mb-1"></i> Darurat
                </button>
            </div>
        </form>
    </section>

    <section id="lacak" class="tab-content space-y-4">
        <h2 class="text-xl font-bold text-grad-green border-b pb-2">Status & Riwayat Laporan</h2>

        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-3">
                <span class="text-xs font-bold text-gray-500">#ADU-0982</span>
                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full">Dalam Proses</span>
            </div>
            <h3 class="font-bold text-gray-800">Tumpukan Sampah Liar - Gg. Damai</h3>
            <p class="text-xs text-gray-500 mb-3"><i class="fa-regular fa-calendar mr-1"></i> 10 Jun 2026</p>
            
            <div class="border-l-2 border-green-500 pl-4 space-y-3 relative text-sm">
                <div class="relative">
                    <div class="absolute -left-[21px] bg-green-500 w-3 h-3 rounded-full"></div>
                    <p class="font-bold text-gray-800">Diterima RT/RW</p>
                    <p class="text-xs text-gray-500">Laporan telah diverifikasi.</p>
                </div>
                <div class="relative">
                    <div class="absolute -left-[21px] bg-yellow-400 w-3 h-3 rounded-full"></div>
                    <p class="font-bold text-gray-800">Penjadwalan Angkut</p>
                    <p class="text-xs text-gray-500">Petugas akan mengambil besok pagi.</p>
                </div>
            </div>
        </div>

        <div class="bg-red-50 p-4 rounded-xl shadow-sm border border-red-100">
            <h3 class="font-bold text-red-800 mb-2"><i class="fa-solid fa-file-invoice-dollar mr-1"></i> Catatan Denda Pelanggaran</h3>
            <div class="flex justify-between items-center bg-white p-3 rounded-lg border border-red-200">
                <div>
                    <p class="text-sm font-semibold">Buang Sampah Sembarangan</p>
                    <p class="text-xs text-gray-500">1x Pelanggaran (Status: Menunggu)</p>
                </div>
                <div class="text-right">
                    <p class="text-red-600 font-bold"><i class="fa-solid fa-rupiah-sign"></i> 50.000</p>
                </div>
            </div>
        </div>
    </section>

    <section id="komunitas" class="tab-content space-y-4">
        <h2 class="text-xl font-bold text-grad-green border-b pb-2">Ruang Interaksi Warga</h2>

        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-4 rounded-xl shadow-sm flex items-center justify-between">
            <div>
                <h3 class="font-bold"><i class="fa-solid fa-trophy mr-1"></i> Apresiasi Warga</h3>
                <p class="text-xs opacity-90">Bulan Ini: Bapak Budi (12 Laporan Selesai)</p>
            </div>
            <div class="bg-white/20 p-2 rounded-full">
                <i class="fa-solid fa-medal text-2xl text-yellow-100"></i>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm text-center">
                <i class="fa-regular fa-comments text-3xl text-green-500 mb-2"></i>
                <h4 class="font-bold text-sm">Forum Diskusi</h4>
                <p class="text-xs text-gray-500 mt-1">Ide daur ulang & jual beli bekas.</p>
            </div>
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm text-center">
                <i class="fa-regular fa-calendar-check text-3xl text-blue-500 mb-2"></i>
                <h4 class="font-bold text-sm">Event & Lomba</h4>
                <p class="text-xs text-gray-500 mt-1">Lomba RT terbersih.</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <h4 class="font-bold text-gray-800 mb-2"><i class="fa-solid fa-play-circle text-red-500 mr-1"></i> Video Edukasi</h4>
            <div class="bg-gray-200 h-32 rounded-lg flex items-center justify-center mb-2">
                <i class="fa-solid fa-play text-4xl text-gray-400"></i>
            </div>
            <p class="text-sm font-semibold">Tutorial Membuat Bank Sampah Mini</p>
        </div>
    </section>
@endsection
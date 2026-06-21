@extends('layouts.user')
@section('title', 'Dashboard - BiSa')

@section('content')
<div class="space-y-8 max-w-6xl mx-auto pb-12">
    
    <!-- Area Header Welcome -->
    <div>
        <h2 class="text-[28px] md:text-3xl font-black text-slate-900 mb-1 tracking-tight">Selamat datang, Ahmad Wijaya!</h2>
        <p class="text-slate-500 text-sm font-medium">Unit: A-101</p>
    </div>

    <!-- Banner Elegan -->
    <div class="bg-gradient-to-r from-emerald-50 to-[#f0fdf4] rounded-2xl p-6 relative border border-emerald-100 flex gap-4 shadow-sm">
        <div class="mt-1"><i class="fa-solid fa-bullhorn text-[#1a8e5f] text-2xl drop-shadow-sm"></i></div>
        <div class="flex-1">
            <div class="flex justify-between items-start mb-2">
                <h2 class="text-lg font-bold text-slate-900">Jadwal Pengambilan Sampah Baru</h2>
                <button class="text-emerald-600 hover:text-emerald-800 transition cursor-pointer relative z-10"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <p class="text-[13px] md:text-sm text-slate-600 leading-relaxed pr-8 md:pr-12">Mulai bulan depan, jadwal pengambilan sampah akan berubah menjadi Senin, Rabu, dan Jumat pukul 06:00 pagi. Mohon persiapkan sampah sejak malam sebelumnya.</p>
            
            <div class="flex items-center justify-between mt-5">
                <div class="flex gap-1.5 items-center">
                    <div class="w-6 h-1.5 bg-[#1a8e5f] rounded-full"></div>
                    <div class="w-1.5 h-1.5 bg-emerald-200 rounded-full"></div>
                    <div class="w-1.5 h-1.5 bg-emerald-200 rounded-full"></div>
                </div>
                <div class="flex items-center gap-4 bg-white px-3 py-1.5 rounded-lg border border-emerald-100 shadow-sm">
                    <button class="text-slate-400 hover:text-[#1a8e5f]"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                    <span class="text-xs font-bold text-slate-700">1 / 3</span>
                    <button class="text-slate-400 hover:text-[#1a8e5f]"><i class="fa-solid fa-chevron-right text-xs"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Stats Cards (Desain Warna Ikon Tajam) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total Laporan</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">4</p>
            </div>
            <div class="w-11 h-11 bg-[#1a8e5f] rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-solid fa-clipboard-list text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Menunggu</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">1</p>
            </div>
            <div class="w-11 h-11 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-regular fa-clock text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Diproses</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">1</p>
            </div>
            <div class="w-11 h-11 bg-blue-500 rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-solid fa-bolt text-lg"></i></div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition flex justify-between h-[104px]">
            <div class="flex flex-col justify-between h-full">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Selesai</p>
                <p class="text-3xl font-black text-slate-900 tracking-tight">2</p>
            </div>
            <div class="w-11 h-11 bg-[#10b981] rounded-xl flex items-center justify-center text-white shadow-sm mt-auto"><i class="fa-regular fa-circle-check text-lg"></i></div>
        </div>
    </div>

    <!-- Tabel Laporan Terbaru -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm mt-6">
        <div class="px-6 py-5 flex justify-between items-center border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Laporan Terbaru</h3>
            <a href="{{ route('user.reports.index') }}" class="text-[13px] font-bold text-[#1a8e5f] hover:underline bg-emerald-50 px-3 py-1.5 rounded-lg">Lihat semua &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 font-bold text-slate-800 text-[13px] uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 font-bold text-slate-900">Tumpukan Sampah Plastik di Dekat Taman</td>
                        <td class="px-6 py-4"><span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">Anorganik</span></td>
                        <td class="px-6 py-4 text-slate-500 font-medium">Dekat Taman Kompleks</td>
                        <td class="px-6 py-4"><span class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-[11px] font-bold">Diproses</span></td>
                        <td class="px-6 py-4 text-slate-400 font-medium">15 Jun 2024</td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 font-bold text-slate-900">Sampah Organik di Area Parkir</td>
                        <td class="px-6 py-4"><span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">Organik</span></td>
                        <td class="px-6 py-4 text-slate-500 font-medium">Area Parkir Blok B</td>
                        <td class="px-6 py-4"><span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-[11px] font-bold">Selesai</span></td>
                        <td class="px-6 py-4 text-slate-400 font-medium">10 Jun 2024</td>
                    </tr>
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 font-bold text-slate-900">Sampah Elektronik Ditinggalkan</td>
                        <td class="px-6 py-4"><span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded text-xs font-bold border border-slate-200">B3 (Berbahaya)</span></td>
                        <td class="px-6 py-4 text-slate-500 font-medium">Pintu Masuk Utama</td>
                        <td class="px-6 py-4"><span class="bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-[11px] font-bold">Menunggu</span></td>
                        <td class="px-6 py-4 text-slate-400 font-medium">18 Jun 2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section Pengumuman Terbaru -->
    <div class="pt-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Pengumuman Kompleks</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <span class="bg-rose-50 text-rose-600 border border-rose-200 px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider mb-4 inline-block">Penting</span>
                    <h4 class="text-base font-bold text-slate-900 mb-2 leading-tight">Pemadaman Listrik Terencana</h4>
                    <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed">Akan ada pemadaman listrik pada hari Sabtu pukul 09:00 - 12:00 terkait perbaikan gardu di area depan kompleks. Harap antisipasi perangkat elektronik.</p>
                </div>
                <button onclick="openAnnouncementModal('Pemadaman Listrik Terencana', 'Sabtu, 22 Juni 2024', 'Akan ada pemadaman listrik pada hari Sabtu pukul 09:00 - 12:00 terkait perbaikan gardu di area depan kompleks.\n\nHarap cabut perangkat elektronik yang rawan rusak saat tegangan kembali menyala.')" class="mt-5 text-[13px] font-bold text-[#1a8e5f] text-left hover:text-[#10b981] transition">Baca Selengkapnya &rarr;</button>
            </div>
            
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <span class="bg-blue-50 text-blue-600 border border-blue-200 px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider mb-4 inline-block">Normal</span>
                    <h4 class="text-base font-bold text-slate-900 mb-2 leading-tight">Kerja Bakti Rutin Bulanan</h4>
                    <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed">Dihimbau kepada seluruh warga untuk mengikuti kerja bakti pembersihan selokan pada Minggu pagi di area masing-masing RT.</p>
                </div>
                <button onclick="openAnnouncementModal('Kerja Bakti Rutin Bulanan', 'Minggu, 23 Juni 2024', 'Dihimbau kepada seluruh warga untuk mengikuti kerja bakti pembersihan selokan pada Minggu pagi di area masing-masing RT.\n\nAlat kebersihan dapat meminjam di balai warga jika persediaan terbatas.')" class="mt-5 text-[13px] font-bold text-[#1a8e5f] text-left hover:text-[#10b981] transition">Baca Selengkapnya &rarr;</button>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider mb-4 inline-block">Info</span>
                    <h4 class="text-base font-bold text-slate-900 mb-2 leading-tight">Pembayaran Iuran Kas</h4>
                    <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed">Mengingatkan batas akhir pembayaran iuran kas dan kebersihan lingkungan paling lambat tanggal 10 setiap bulannya.</p>
                </div>
                <button onclick="openAnnouncementModal('Pembayaran Iuran Kas', 'Setiap Tanggal 10', 'Mengingatkan batas akhir pembayaran iuran kas dan kebersihan lingkungan paling lambat tanggal 10 setiap bulannya. Pembayaran dapat dilakukan via transfer ke bendahara RT.')" class="mt-5 text-[13px] font-bold text-[#1a8e5f] text-left hover:text-[#10b981] transition">Baca Selengkapnya &rarr;</button>
            </div>
        </div>
    </div>

</div>
@endsection
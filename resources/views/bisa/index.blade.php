@extends('layouts.app')

@section('content')
<style>
    /* Mengatur warna dasar web */
    body { background-color: #f8fafc; }
    
    /* Header melengkung bawah seperti di gambar */
    .header-green {
        background-color: #1a8e5f;
        border-bottom-left-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }

    /* Styling khusus untuk Timeline di tab Lacak */
    .timeline-container { position: relative; padding-left: 1.5rem; margin-top: 1rem; }
    .timeline-item { position: relative; padding-bottom: 1.5rem; }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -1.2rem;
        top: 0.2rem;
        height: 100%;
        width: 2px;
        background-color: #e5e7eb;
    }
    .timeline-item:last-child::before { display: none; }
    .timeline-dot {
        position: absolute;
        left: -1.45rem;
        top: 0.3rem;
        width: 0.6rem;
        height: 0.6rem;
        border-radius: 50%;
        background-color: #9ca3af;
    }
    .timeline-dot.active { background-color: #10b981; }

    /* Hide scrollbar untuk tampilan bersih */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>

<div class="w-full max-w-7xl mx-auto px-4 pb-24">

    <section id="beranda" class="tab-content active space-y-6 mt-4">
        <div class="header-green text-white p-6 -mx-4 sm:mx-0 shadow-sm">
            <h2 class="text-2xl font-bold">Selamat Datang</h2>
            <p class="text-sm opacity-90">Mari bersama menjaga lingkungan</p>
        </div>

        <div class="space-y-4">
            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                <h3 class="font-bold text-emerald-800 mb-3 flex items-center gap-2">
                    <i class="fa-regular fa-bell"></i> Info Cepat
                </h3>
                <div class="space-y-2">
                    <div class="bg-white p-3 rounded-lg border border-emerald-100 shadow-sm">
                        <p class="font-semibold text-gray-800 text-sm">Kerja Bakti Minggu Ini</p>
                        <p class="text-xs text-gray-500">Minggu, 15 Desember 2024 - 07:00 WITA | Lokasi: Taman RT 12</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-emerald-100 shadow-sm">
                        <p class="font-semibold text-gray-800 text-sm">Jadwal Pengangkutan Sampah</p>
                        <p class="text-xs text-gray-500">Setiap Selasa & Jumat - 06:00 WITA</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
                    <i class="fa-solid fa-chart-line text-emerald-500 text-2xl mb-2"></i>
                    <p class="font-bold text-2xl text-gray-800">24</p>
                    <p class="text-xs text-gray-500">Laporan Bulan Ini</p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm text-center">
                    <i class="fa-regular fa-circle-check text-emerald-500 text-2xl mb-2"></i>
                    <p class="font-bold text-2xl text-gray-800">18</p>
                    <p class="text-xs text-gray-500">Sudah Ditangani</p>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-3 border-b pb-2">Artikel Edukasi</h3>
                <div class="space-y-4">
                    <div class="border border-gray-100 p-3 rounded-lg">
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded">Tips</span>
                        <h4 class="font-bold text-gray-800 mt-2 text-sm">Cara Memilah Sampah Organik & Anorganik</h4>
                        <p class="text-xs text-gray-500 mt-1 mb-2">Pelajari cara yang benar untuk memisahkan sampah agar mudah didaur ulang.</p>
                        <button class="border border-gray-300 text-gray-600 text-xs px-3 py-1 rounded hover:bg-gray-50">Baca Selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pengaduan" class="tab-content space-y-6 mt-4">
        <div class="header-green text-white p-6 -mx-4 sm:mx-0 shadow-sm">
            <h2 class="text-2xl font-bold">Laporkan Sampah</h2>
            <p class="text-sm opacity-90">Bantu komunitas dengan melaporkan masalah sampah</p>
        </div>

        <form action="#" method="POST" class="space-y-4">
            @csrf
            
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex justify-between items-center">
                <div class="flex items-start gap-3">
                    <div class="bg-red-100 text-red-600 p-2 rounded-full"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div>
                        <h4 class="text-red-800 font-bold text-sm">Laporan Darurat</h4>
                        <p class="text-red-600 text-xs">Untuk sampah menumpuk & berbau, kami akan menindaklanjuti mendesak.</p>
                    </div>
                </div>
                <button type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition">Lapor Cepat</button>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-5">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 border-b pb-2"><i class="fa-regular fa-pen-to-square"></i> Form Pengaduan</h3>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Sampah</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-10 text-center bg-gray-50 hover:bg-gray-100 cursor-pointer transition">
                        <i class="fa-solid fa-camera text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk mengunggah foto dari upload gambar</p>
                        <button type="button" class="mt-3 bg-white border border-gray-300 px-4 py-1.5 rounded text-sm text-gray-700 shadow-sm"><i class="fa-solid fa-upload mr-1"></i> Pilih Foto</button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori Sampah</label>
                    <select class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-emerald-500 bg-gray-50">
                        <option>Pilih kategori sampah...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea rows="3" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-emerald-500 bg-gray-50" placeholder="Jelaskan kondisi sampah dan lokasinya..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <div class="flex gap-2">
                        <input type="text" class="w-full border border-gray-200 rounded-lg p-3 text-sm bg-gray-50" placeholder="Masukkan alamat atau deskripsi lokasi">
                        <button type="button" class="bg-white border border-gray-200 text-gray-600 px-4 rounded-lg shadow-sm hover:bg-gray-50"><i class="fa-solid fa-location-dot"></i></button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#65b38a] hover:bg-emerald-600 text-white font-bold py-3 rounded-lg shadow transition">Kirim Laporan</button>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                <h4 class="font-bold text-gray-800 text-sm mb-3">Tips Pelaporan yang Baik</h4>
                <ul class="list-disc list-inside text-xs text-gray-600 space-y-1">
                    <li>Ambil foto yang jelas menunjukkan kondisi sampah</li>
                    <li>Berikan deskripsi lokasi yang spesifik (nama jalan, patokan)</li>
                    <li>Pilih kategori yang tepat agar penanganan lebih efektif</li>
                    <li>Gunakan laporan darurat hanya untuk kasus mendesak</li>
                </ul>
            </div>
        </form>
    </section>

    <section id="lacak" class="tab-content space-y-4 mt-4">
        <div class="header-green text-white p-6 -mx-4 sm:mx-0 shadow-sm">
            <h2 class="text-2xl font-bold">Lacak Aduan</h2>
            <p class="text-sm opacity-90">Pantau progres laporan Anda</p>
        </div>

        <div class="bg-white p-2 rounded-xl border border-gray-200 shadow-sm flex items-center px-4">
            <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2"></i>
            <input type="text" placeholder="Cari berdasarkan ID, lokasi, atau kategori..." class="w-full p-2 outline-none text-sm">
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-gray-800">#ADU001</span>
                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-bold px-2 py-1 rounded-full"><i class="fa-solid fa-check mr-1"></i> Selesai</span>
                </div>
                <button class="text-xs border border-gray-300 px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-50"><i class="fa-regular fa-eye mr-1"></i> Detail</button>
            </div>
            
            <div class="flex flex-wrap gap-4 text-xs text-gray-500 mb-4">
                <span><i class="fa-regular fa-calendar mr-1"></i> 2024-12-10</span>
                <span><i class="fa-solid fa-location-dot mr-1"></i> Jl. Mawar No. 15</span>
            </div>
            <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded border border-gray-200">Sampah Liar</span>

            <div class="mt-4 border-t pt-4">
                <p class="text-xs font-bold text-gray-700 mb-2">Timeline Progres:</p>
                <div class="timeline-container">
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Dikirim</p>
                        <p class="text-[10px] text-gray-500">Laporan berhasil dikirim<br>2024-12-10 08:00</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Diterima Ketua RT/RW</p>
                        <p class="text-[10px] text-gray-500">Laporan diterima RT 05<br>2024-12-10 10:30</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Dalam Proses</p>
                        <p class="text-[10px] text-gray-500">Tim kebersihan menuju lokasi<br>2024-12-11 07:00</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Selesai</p>
                        <p class="text-[10px] text-gray-500">Sampah berhasil diangkut<br>2024-12-11 09:15</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-gray-800">#ADU002</span>
                    <span class="bg-blue-50 text-blue-600 border border-blue-200 text-[10px] font-bold px-2 py-1 rounded-full"><i class="fa-regular fa-clock mr-1"></i> Dalam Proses</span>
                </div>
                <button class="text-xs border border-gray-300 px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-50"><i class="fa-regular fa-eye mr-1"></i> Detail</button>
            </div>
            
            <div class="flex flex-wrap gap-4 text-xs text-gray-500 mb-4">
                <span><i class="fa-regular fa-calendar mr-1"></i> 2024-12-12</span>
                <span><i class="fa-solid fa-location-dot mr-1"></i> Taman RT 03</span>
            </div>
            <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded border border-gray-200">Sampah Besar</span>

            <div class="mt-4 border-t pt-4">
                <p class="text-xs font-bold text-gray-700 mb-2">Timeline Progres:</p>
                <div class="timeline-container">
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Dikirim</p>
                        <p class="text-[10px] text-gray-500">Laporan berhasil dikirim<br>2024-12-12 14:00</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Diterima Ketua RT/RW</p>
                        <p class="text-[10px] text-gray-500">Laporan diterima RT 03<br>2024-12-12 16:00</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <p class="text-xs font-bold text-gray-800">Dalam Proses</p>
                        <p class="text-[10px] text-gray-500">Dijadwalkan kerja bakti besok pagi<br>2024-12-13 08:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="komunitas" class="tab-content space-y-4 mt-4">
        <div class="header-green text-white p-6 -mx-4 sm:mx-0 shadow-sm">
            <h2 class="text-2xl font-bold">Komunitas</h2>
            <p class="text-sm opacity-90">Bergabung dengan gerakan lingkungan</p>
        </div>

        <div class="flex gap-2 bg-transparent overflow-x-auto pb-2">
            <button class="bg-white text-gray-800 border border-gray-200 px-6 py-2 rounded-lg text-sm shadow-sm font-semibold whitespace-nowrap w-1/4">Forum</button>
            <button class="text-gray-500 px-6 py-2 rounded-lg text-sm hover:bg-white whitespace-nowrap w-1/4">Info</button>
            <button class="text-gray-500 px-6 py-2 rounded-lg text-sm hover:bg-white whitespace-nowrap w-1/4">Edukasi</button>
            <button class="text-gray-500 px-6 py-2 rounded-lg text-sm hover:bg-white whitespace-nowrap w-1/4">Ranking</button>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-gray-800 flex items-center gap-2 mb-3"><i class="fa-regular fa-comment-dots"></i> Bagikan Ide Anda</h3>
            <textarea rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-1 focus:ring-emerald-500" placeholder="Bagikan tips, ide, atau pertanyaan tentang pengelolaan sampah..."></textarea>
            
            <div class="flex justify-between items-center mt-3">
                <div class="flex gap-2">
                    <button class="bg-white border border-gray-300 text-gray-600 px-3 py-1 rounded text-[10px] font-semibold hover:bg-gray-50">Tips</button>
                    <button class="bg-white border border-gray-300 text-gray-600 px-3 py-1 rounded text-[10px] font-semibold hover:bg-gray-50">Jual Beli</button>
                    <button class="bg-white border border-gray-300 text-gray-600 px-3 py-1 rounded text-[10px] font-semibold hover:bg-gray-50">DIY</button>
                </div>
                <button class="bg-[#8ecba8] hover:bg-emerald-500 text-white px-5 py-2 rounded text-sm font-semibold flex items-center gap-2"><i class="fa-regular fa-paper-plane"></i> Posting</button>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://ui-avatars.com/api/?name=Ibu+Sari&background=random" class="w-8 h-8 rounded-full" alt="Avatar">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Ibu Sari <span class="text-[10px] text-gray-400 font-normal ml-2">2 jam lalu</span> <span class="bg-emerald-100 text-emerald-700 text-[10px] px-2 py-0.5 rounded ml-1">Tips</span></p>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mb-4">Ada yang tahu cara membuat kompos dari sampah dapur? Saya ingin mulai mengurangi sampah organik di rumah.</p>
                <div class="flex gap-6 text-xs text-gray-500">
                    <button class="hover:text-emerald-600"><i class="fa-regular fa-heart mr-1"></i> 12</button>
                    <button class="hover:text-emerald-600"><i class="fa-regular fa-comment mr-1"></i> 5</button>
                    <button class="hover:text-emerald-600"><i class="fa-solid fa-share-nodes mr-1"></i> Bagikan</button>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://ui-avatars.com/api/?name=Pak+Budi&background=random" class="w-8 h-8 rounded-full" alt="Avatar">
                    <div>
                        <p class="text-sm font-bold text-gray-800">Pak Budi <span class="text-[10px] text-gray-400 font-normal ml-2">5 jam lalu</span> <span class="bg-teal-100 text-teal-700 text-[10px] px-2 py-0.5 rounded ml-1">Jual Beli</span></p>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mb-4">Jual botol plastik bekas, kondisi bersih. Cocok untuk kerajinan atau pot tanaman. Harga 500/botol. Minat chat ya!</p>
                <div class="flex gap-6 text-xs text-gray-500">
                    <button class="hover:text-emerald-600"><i class="fa-regular fa-heart mr-1"></i> 8</button>
                    <button class="hover:text-emerald-600"><i class="fa-regular fa-comment mr-1"></i> 3</button>
                    <button class="hover:text-emerald-600"><i class="fa-solid fa-share-nodes mr-1"></i> Bagikan</button>
                </div>
            </div>
        </div>
    </section>

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
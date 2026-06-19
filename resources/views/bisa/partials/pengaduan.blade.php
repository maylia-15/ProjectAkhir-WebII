<section id="pengaduan" class="tab-content space-y-6 mt-4">
    <div class="header-green text-white p-6 -mx-4 sm:mx-0 shadow-sm">
        <h2 class="text-2xl font-bold">Laporkan Sampah</h2>
        <p class="text-sm opacity-90">Bantu komunitas dengan melaporkan masalah sampah di lingkungan Anda</p>
    </div>

    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="bg-red-100 text-red-600 p-2.5 rounded-full mt-1 sm:mt-0 flex items-center justify-center">
                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
            </div>
            <div>
                <h4 class="text-red-800 font-bold text-sm">Laporan Darurat</h4>
                <p class="text-red-600 text-xs mt-1 leading-relaxed">Gunakan fitur ini untuk sampah yang menumpuk berhari-hari, berbau menyengat, atau menghalangi akses jalan darurat.</p>
            </div>
        </div>
        <button type="button" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm shadow transition shrink-0 whitespace-nowrap">
            Lapor Cepat
        </button>
    </div>

    <form action="#" method="POST" class="bg-white p-6 sm:p-8 rounded-xl border border-gray-200 shadow-sm space-y-6">
        @csrf
        
        <h3 class="font-bold text-gray-800 flex items-center gap-2 border-b border-gray-100 pb-3 text-lg">
            <i class="fa-regular fa-pen-to-square text-[#1a8e5f]"></i> Form Pengaduan
        </h3>
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Sampah <span class="text-red-500">*</span></label>
            <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center bg-gray-50 hover:bg-emerald-50 hover:border-emerald-300 cursor-pointer transition group">
                <input type="file" name="foto_sampah" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" required>
                
                <div class="pointer-events-none">
                    <i class="fa-solid fa-camera text-4xl text-gray-400 group-hover:text-[#1a8e5f] mb-3 transition transform group-hover:scale-110"></i>
                    <p class="text-sm text-gray-600 font-medium">Klik atau seret foto ke area ini</p>
                    <p class="text-xs text-gray-400 mt-1">Maksimal ukuran file 5MB (JPG, PNG)</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Sampah <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#1a8e5f] focus:border-[#1a8e5f] bg-gray-50 outline-none transition" required>
                    <option value="">Pilih kategori sampah...</option>
                    <option value="liar">Sampah Liar (Tumpukan di jalan)</option>
                    <option value="rumah_tangga">Sampah Rumah Tangga</option>
                    <option value="besar">Sampah Besar (Perabotan, Elektronik)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Penanganan <span class="text-red-500">*</span></label>
                <select name="penanganan" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#1a8e5f] focus:border-[#1a8e5f] bg-gray-50 outline-none transition" required>
                    <option value="">Pilih jenis penanganan...</option>
                    <option value="angkut">Minta Diangkut Petugas</option>
                    <option value="kerja_bakti">Usulkan Kerja Bakti Warga</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="3" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-2 focus:ring-[#1a8e5f] focus:border-[#1a8e5f] bg-gray-50 outline-none transition resize-y" placeholder="Jelaskan kondisi sampah..." required></textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Terkini <span class="text-red-500">*</span></label>
            <div class="flex gap-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-map-location-dot text-gray-400"></i>
                </div>
                <input type="text" name="lokasi" class="w-full border border-gray-200 rounded-lg p-3 pl-10 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a8e5f] focus:border-[#1a8e5f] outline-none transition" placeholder="Contoh: Jl. Brigjen Hasan Basri..." required>
                
                <button type="button" class="bg-white border border-gray-200 text-gray-600 px-4 rounded-lg shadow-sm hover:bg-gray-50 hover:text-[#1a8e5f] transition flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-location-crosshairs text-lg"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#1a8e5f] hover:bg-emerald-700 text-white font-bold py-3.5 rounded-lg shadow-md transition flex items-center justify-center gap-2 mt-2">
            <i class="fa-solid fa-paper-plane"></i> Kirim Laporan
        </button>
    </form>
</section>
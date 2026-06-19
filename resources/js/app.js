// Import bootstrap bawaan laravel jika diperlukan
// import './bootstrap';

/**
 * 1. LOGIKA NAVIGASI UTAMA (MAIN TAB SWITCHING)
 * Diikat ke objek 'window' agar bisa dipanggil langsung dari atribut onclick="" di Blade
 */
window.switchTab = function (tabId, btnElement) {
    // Sembunyikan semua section konten tab
    document.querySelectorAll(".tab-content").forEach((tab) => {
        tab.classList.add("hidden");
        tab.classList.remove("active");
    });

    // Tampilkan konten tab yang dipilih
    const activeTab = document.getElementById(tabId);
    if (activeTab) {
        activeTab.classList.remove("hidden");
        activeTab.classList.add("active");
    }

    // Reset semua tombol navigasi ke warna abu-abu (tidak aktif)
    document.querySelectorAll(".nav-btn").forEach((btn) => {
        btn.classList.remove("text-emerald-600");
        btn.classList.add("text-gray-400");
    });

    // Berikan warna hijau (aktif) pada tombol yang diklik
    btnElement.classList.remove("text-gray-400");
    btnElement.classList.add("text-emerald-600");

    // Gulir otomatis ke atas halaman secara halus
    window.scrollTo({ top: 0, behavior: "smooth" });
};

/**
 * 2. LOGIKA INTERAKTIF FORM & SUB-TAB
 * Dijalankan setelah seluruh struktur HTML selesai dimuat (DOMContentLoaded)
 */
document.addEventListener("DOMContentLoaded", function () {
    // === PILIH FOTO & PREVIEW (TAB PENGADUAN) ===
    const fileInput = document.querySelector('input[name="foto_sampah"]');
    const uploadContainer = fileInput?.closest(".relative");

    if (fileInput && uploadContainer) {
        fileInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (Maksimal 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert("Ukuran file terlalu besar! Maksimal adalah 5MB.");
                    fileInput.value = ""; // Reset input
                    return;
                }

                // Mengubah teks dalam kotak upload menjadi nama file yang dipilih
                const textContainer = uploadContainer.querySelector(
                    ".pointer-events-none",
                );
                if (textContainer) {
                    textContainer.innerHTML = `
                        <i class="fa-solid fa-circle-check text-4xl text-emerald-500 mb-3"></i>
                        <p class="text-sm text-gray-800 font-bold">Foto Berhasil Dipilih!</p>
                        <p class="text-xs text-emerald-600 mt-1">${file.name}</p>
                    `;
                }
            }
        });
    }

    // === DETEKSI LOKASI AUTOMATIS / GPS (TAB PENGADUAN) ===
    const gpsButton = document.querySelector(
        'button[title="Gunakan GPS Perangkat"]',
    );
    const locationInput = document.querySelector('input[name="lokasi"]');

    if (gpsButton && locationInput) {
        gpsButton.addEventListener("click", function () {
            // Ubah ikon menjadi animasi loading saat mendeteksi lokasi
            const icon = gpsButton.querySelector("i");
            icon.className =
                "fa-solid fa-spinner fa-spin text-lg text-emerald-600";

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        locationInput.value = `Koordinat GPS: ${lat}, ${lng} (Lokasi Terdeteksi)`;

                        icon.className =
                            "fa-solid fa-location-crosshairs text-lg";
                    },
                    function (error) {
                        alert(
                            "Gagal mendeteksi lokasi. Pastikan izin GPS diaktifkan pada browser Anda.",
                        );
                        icon.className =
                            "fa-solid fa-location-crosshairs text-lg";
                    },
                );
            } else {
                alert("Browser Anda tidak mendukung fitur Geolocation GPS.");
                icon.className = "fa-solid fa-location-crosshairs text-lg";
            }
        });
    }

    const subTabButtons = document.querySelectorAll(
        "#komunitas .flex.gap-2 button",
    );

    subTabButtons.forEach((button) => {
        button.addEventListener("click", function () {
            subTabButtons.forEach((btn) => {
                btn.className =
                    "text-gray-500 px-6 py-2 rounded-lg text-sm hover:bg-white whitespace-nowrap w-1/4 transition";
            });

            this.className =
                "bg-white text-gray-800 border border-gray-200 px-6 py-2 rounded-lg text-sm shadow-sm font-semibold whitespace-nowrap w-1/4 transition";

            const subTabName = this.textContent.trim();
            console.log(`Berpindah ke sub-tab komunitas: ${subTabName}`);
        });
    });
});

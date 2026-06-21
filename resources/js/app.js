document.addEventListener("DOMContentLoaded", function () {
    // 1. TOGGLE SIDEBAR DESKTOP (Buka/Tutup)
    window.toggleSidebar = function () {
        const sidebar = document.getElementById("sidebar");
        const openBtn = document.getElementById("open-sidebar-btn");

        if (sidebar && openBtn) {
            // Geser sidebar ke kiri sebesar lebarnya (64 x 4px = 256px)
            sidebar.classList.toggle("-ml-64");

            // Atur tombol menu agar muncul saat sidebar sembunyi, dan sebaliknya
            if (sidebar.classList.contains("-ml-64")) {
                openBtn.classList.remove("hidden");
                openBtn.classList.add("flex");
            } else {
                openBtn.classList.add("hidden");
                openBtn.classList.remove("flex");
            }
        }
    };

    // 2. DRAWER MOBILE (Tampil/Sembunyi di HP)
    window.openMobileDrawer = () =>
        document.getElementById("mobile-drawer")?.classList.remove("hidden");
    window.closeMobileDrawer = () =>
        document.getElementById("mobile-drawer")?.classList.add("hidden");

    // 3. DROPDOWN/DROPUP PROFIL MELAYANG
    const profileBtn = document.getElementById("profile-menu-btn");
    const profileDropdown = document.getElementById("profile-dropdown");

    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            profileDropdown.classList.toggle("hidden");
        });
        window.addEventListener("click", function (e) {
            if (
                !profileBtn.contains(e.target) &&
                !profileDropdown.contains(e.target)
            ) {
                profileDropdown.classList.add("hidden");
            }
        });
    }

    // 4. TUTUP BANNER DASHBOARD
    const bannerCloseBtn = document.querySelector(".fa-xmark")?.parentElement;
    if (bannerCloseBtn && bannerCloseBtn.closest(".bg-gradient-to-r")) {
        bannerCloseBtn.addEventListener("click", function () {
            const banner = this.closest(".bg-gradient-to-r");
            banner.style.transition = "opacity 0.3s ease, transform 0.3s ease";
            banner.style.opacity = "0";
            banner.style.transform = "translateY(-10px)";
            setTimeout(() => banner.remove(), 300);
        });
    }

    // 5. MODAL PENGUMUMAN
    window.openAnnouncementModal = function (title, date, content) {
        document.getElementById("modal-title").textContent = title;
        document.getElementById("modal-date").textContent = date;
        document.getElementById("modal-content").textContent = content;
        document
            .getElementById("announcement-modal")
            .classList.remove("hidden");
    };
    window.closeAnnouncementModal = () =>
        document.getElementById("announcement-modal").classList.add("hidden");
});

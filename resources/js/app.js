document.addEventListener("DOMContentLoaded", function () {
    // ========================================================
    // 1. TOGGLE SIDEBAR DESKTOP (Buka/Tutup)
    // ========================================================
    window.toggleSidebar = function () {
        const sidebar = document.getElementById("sidebar");
        const openBtn = document.getElementById("open-sidebar-btn");

        if (sidebar && openBtn) {
            sidebar.classList.toggle("-ml-64");

            if (sidebar.classList.contains("-ml-64")) {
                openBtn.classList.remove("hidden");
                openBtn.classList.add("flex");
            } else {
                openBtn.classList.add("hidden");
                openBtn.classList.remove("flex");
            }
        }
    };

    // ========================================================
    // 2. DRAWER MOBILE (Tampil/Sembunyi di HP)
    // ========================================================
    window.openMobileDrawer = () =>
        document.getElementById("mobile-drawer")?.classList.remove("hidden");
    window.closeMobileDrawer = () =>
        document.getElementById("mobile-drawer")?.classList.add("hidden");

    // ========================================================
    // 3. DROPDOWN/DROPUP PROFIL MELAYANG
    // ========================================================
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

    // ========================================================
    // 4. TUTUP BANNER DASHBOARD
    // ========================================================
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

    // ========================================================
    // 5. MODAL PENGUMUMAN
    // ========================================================
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

    // ========================================================
    // 6. VALIDASI FORM REGISTRASI
    // ========================================================
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector(
        'input[name="password_confirmation"]',
    );
    const noHpInput = document.querySelector('input[name="no_hp"]');

    if (passwordInput && confirmPasswordInput && noHpInput) {
        const registerForm = noHpInput.closest("form");

        function showError(inputElement, message) {
            clearError(inputElement);
            const errorMsg = document.createElement("p");
            errorMsg.className = "text-red-500 text-xs mt-1 js-error-msg";
            errorMsg.innerText = message;
            inputElement.parentElement.appendChild(errorMsg);
        }

        function clearError(inputElement) {
            const existingError =
                inputElement.parentElement.querySelector(".js-error-msg");
            if (existingError) {
                existingError.remove();
            }
        }

        registerForm.addEventListener("submit", function (event) {
            let isValid = true;
            document
                .querySelectorAll(".js-error-msg")
                .forEach((e) => e.remove());

            if (passwordInput.value !== confirmPasswordInput.value) {
                showError(
                    confirmPasswordInput,
                    "Konfirmasi password tidak cocok dengan password di atas.",
                );
                isValid = false;
            }

            const hpRegex = /^[0-9]{10,15}$/;
            if (!hpRegex.test(noHpInput.value)) {
                showError(
                    noHpInput,
                    "Nomor HP tidak valid (harus berupa 10-15 digit angka).",
                );
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        confirmPasswordInput.addEventListener("input", function () {
            if (passwordInput.value === confirmPasswordInput.value) {
                clearError(confirmPasswordInput);
            }
        });
    }

    // ========================================================
    // 7. ANIMASI LANDING PAGE
    // ========================================================
    const statsContainer = document.querySelector(".grid-cols-4.text-center");

    if (statsContainer) {
        // Animasi Angka Berjalan
        const statNumbers = statsContainer.querySelectorAll(
            "span.text-\\[32px\\]",
        );
        let animated = false;

        const animateNumbers = () => {
            statNumbers.forEach((stat) => {
                const target = parseInt(stat.innerText, 10);
                if (isNaN(target)) return;

                let current = 0;
                const increment = target / 40;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.innerText = target;
                        clearInterval(timer);
                    } else {
                        stat.innerText = Math.ceil(current);
                    }
                }, 30);
            });
        };

        const observer = new IntersectionObserver(
            (entries) => {
                if (entries[0].isIntersecting && !animated) {
                    animateNumbers();
                    animated = true;
                }
            },
            { threshold: 0.5 },
        );

        observer.observe(statsContainer);

        // Animasi Fade-In Kartu Fitur
        const featureCards = document.querySelectorAll(
            ".grid-cols-1.md\\:grid-cols-3 > div",
        );

        featureCards.forEach((card, index) => {
            card.style.opacity = "0";
            card.style.transform = "translateY(30px)";
            card.style.transition = `opacity 0.6s ease ${index * 0.15}s, transform 0.6s ease ${index * 0.15}s`;

            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            }, 100);
        });
    }
});

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Semua kode yang berinteraksi dengan HTML kita letakkan di sini
document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Ambil semua elemen yang dibutuhkan satu kali saja di awal.
    const header = document.getElementById("header");
    const navcontent = document.getElementById("nav-content");
    const navaction = document.getElementById("navAction");
    const brandname = document.getElementById("brandname");
    const toToggle = document.querySelectorAll(".toggleColour");
    const navMenu = document.getElementById("nav-toggle");

    // 2. Lakukan pengecekan: Jalankan kode hanya jika elemen utama (header) ada.
    //    Ini membuat kode tidak error di halaman yang mungkin tidak memiliki navbar.
    if (header) {
        // --- LOGIKA UNTUK EFEK SCROLL ---
        document.addEventListener("scroll", function () {
            const scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-white", "shadow");
                if(navaction) navaction.classList.replace("bg-white", "gradient");
                if(navaction) navaction.classList.replace("text-gray-800", "text-white");
                
                toToggle.forEach(function(element) {
                    element.classList.add("text-gray-800");
                    element.classList.remove("text-white");
                });
                
                if(navcontent) navcontent.classList.replace("bg-gray-100", "bg-white");
            } else {
                header.classList.remove("bg-white", "shadow");
                if(navaction) navaction.classList.replace("gradient", "bg-white");
                if(navaction) navaction.classList.replace("text-white", "text-gray-800");

                toToggle.forEach(function(element) {
                    element.classList.add("text-white");
                    element.classList.remove("text-gray-800");
                });

                if(navcontent) navcontent.classList.replace("bg-white", "bg-gray-100");
            }
        });
    }


    // --- LOGIKA UNTUK MENU DROPDOWN/MOBILE (HAMBURGER MENU) ---
    if (navMenu && navcontent) {
        const checkParent = (t, elm) => {
            while (t.parentNode) {
                if (t == elm) return true;
                t = t.parentNode;
            }
            return false;
        };

        const check = (e) => {
            const target = e.target;

            // Nav Menu
            if (!checkParent(target, navcontent)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navcontent.classList.contains("hidden")) {
                        navcontent.classList.remove("hidden");
                    } else {
                        navcontent.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navcontent.classList.add("hidden");
                }
            }
        };
        
        document.addEventListener('click', check);
    }

});
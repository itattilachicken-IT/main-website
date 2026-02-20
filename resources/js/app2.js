import './bootstrap';
import Chart from 'chart.js/auto';

window.toggleSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");

    document.getElementById("dashboardLayout")
        .classList.toggle("collapsed");
};


document.addEventListener("DOMContentLoaded", function () {

    const navLinks = document.querySelectorAll(".handbook-nav .nav-link2");
    const sections = document.querySelectorAll(".handbook-section");

    navLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const target = this.getAttribute("data-section");

            // remove active from all links
            navLinks.forEach(l => l.classList.remove("actived"));

            // hide all sections
            sections.forEach(section => {
                section.classList.remove("actived");
            });

            // activate clicked link
            this.classList.add("actived");

            // show correct section
            const targetSection = document.getElementById(target);
            if (targetSection) {
                targetSection.classList.add("actived");
            }
        });
    });

});

// Chart initialization removed for investor landing (reverted)

<!-- jQuery (optional, not required for Bootstrap 5) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const navbarCollapse = document.querySelector(".navbar-collapse");
    
    // ---------------------------
    // Search Form Toggle
    // ---------------------------
    const searchToggle = document.getElementById("searchToggle");
    const searchForm = document.getElementById("searchForm");
    if (searchToggle && searchForm) {
        searchToggle.addEventListener("click", function (e) {
            e.preventDefault();
            searchForm.classList.toggle("show");
        });
    }

    // ---------------------------
    // Mobile Nav Close Button
    // ---------------------------
    const closeMenu = document.querySelector(".navbar-collapse .close-menu");
    if (closeMenu && navbarCollapse) {
        closeMenu.addEventListener("click", function () {
            navbarCollapse.classList.remove("show");
            // close all mobile dropdowns
            document.querySelectorAll('.navbar-nav .dropdown.show').forEach(drop => {
                drop.classList.remove('show');
                drop.querySelector('.dropdown-menu')?.classList.remove('show');
            });
        });
    }

    // ---------------------------
    // Mobile Dropdown Toggle (with arrow)
    // ---------------------------
    function initMobileDropdowns() {
        if (window.innerWidth >= 992) return; // desktop: do nothing

        document.querySelectorAll('.navbar-nav .dropdown-toggle').forEach(toggle => {
            toggle.onclick = function (e) {
                const parent = toggle.parentElement;
                const menu = parent.querySelector('.dropdown-menu');

                if (!parent.classList.contains('show')) {
                    e.preventDefault(); // first tap: open submenu

                    // close other open dropdowns
                    document.querySelectorAll('.navbar-nav .dropdown.show').forEach(open => {
                        if (open !== parent) {
                            open.classList.remove('show');
                            open.querySelector('.dropdown-menu')?.classList.remove('show');
                        }
                    });

                    parent.classList.add('show');
                    menu?.classList.add('show');
                }
                // second tap will follow link normally
            };
        });
    }

    initMobileDropdowns();
    window.addEventListener("resize", initMobileDropdowns);

    // ---------------------------
    // Auto-close mobile menu on link click (non-dropdown)
    // ---------------------------
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link:not(.dropdown-toggle)");
    navLinks.forEach(link => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 992 && navbarCollapse.classList.contains("show")) {
                navbarCollapse.classList.remove("show");
                // close mobile dropdowns
                document.querySelectorAll('.navbar-nav .dropdown.show').forEach(drop => {
                    drop.classList.remove('show');
                    drop.querySelector('.dropdown-menu')?.classList.remove('show');
                });
            }
        });
    });

    // ---------------------------
    // Reset mobile dropdowns on desktop resize
    // ---------------------------
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.navbar-nav .dropdown-menu').forEach(menu => menu.classList.remove('show'));
            document.querySelectorAll('.navbar-nav .dropdown.show').forEach(drop => drop.classList.remove('show'));
        }
    });
});
</script>

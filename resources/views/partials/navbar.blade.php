<!-- Top Info Bar -->
<div id="top-info-bar" class="bg-black text-warning py-1 py-md-2 fw-bold">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start top-info-text">
        
        <!-- Contact Info -->
        <div class="d-flex flex-wrap gap-2 gap-md-4 justify-content-center justify-content-md-start mb-1 mb-md-0">
            <span>
                <a href="tel:+254700354354" class="text-warning text-decoration-none me-1" data-bs-toggle="tooltip" title="Call us">
                    <i class="bi bi-telephone"></i>
                </a>/ 
                <a href="https://wa.me/254700354354" target="_blank" class="text-warning text-decoration-none me-1" data-bs-toggle="tooltip" title="Chat on WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
                +254 700354354
            </span>
            <span>
                <a href="tel:+254700222822" class="text-warning text-decoration-none me-1" data-bs-toggle="tooltip" title="Call us">
                    <i class="bi bi-telephone"></i>
                </a>/ 
                <a href="https://wa.me/254700222822" target="_blank" class="text-warning text-decoration-none me-1" data-bs-toggle="tooltip" title="Chat on WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>
                +254 700222822
            </span>
            <span>
                <a href="mailto:info@attilachicken.com" class="text-warning text-decoration-none">
                    <i class="bi bi-envelope"></i> info@attilachicken.com
                </a>
            </span>
            <span>
                <i class="bi bi-globe"></i>
                <a href="https://attilachicken.com" target="_blank" class="text-warning text-decoration-none">www.attilachicken.com</a>
            </span>
        </div>

        <!-- Social Icons -->
        <div class="d-flex gap-2 gap-md-4 justify-content-center justify-content-md-end mt-1 mt-md-0 flex-wrap">
            <a href="https://www.facebook.com/AttilaChicken" target="_blank" class="text-warning"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/attiladachicken" target="_blank" class="text-warning"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/@attilafarms" target="_blank" class="text-warning"><i class="bi bi-tiktok"></i></a>
            <a href="https://youtube.com/@attiladachicken?si=4htNcFFr6yvsyDLA" target="_blank" class="text-warning"><i class="bi bi-youtube"></i></a>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top" id="main-navbar">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('images/logo1.jpg') }}" alt="Attila Chicken" height="40">
        </a>

        <!-- Mobile Search Form (visible only on mobile) -->
        <form action="{{ route('shop.search') }}" method="GET" 
              id="mobileSearchForm"
              class="d-flex flex-grow-1 mx-2 d-lg-none">
            <input class="form-control form-control-sm" type="search" name="q" placeholder="Search..." aria-label="Search" required>
            <button class="btn btn-warning btn-sm ms-2 fw-bold" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links + Desktop Search Icon -->
        <div class="collapse navbar-collapse" id="navbarNav">
            @include('partials.nav-links')

            <!-- Desktop Search Icon -->
            <ul class="navbar-nav ms-auto align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link text-warning fw-bold" href="javascript:void(0);" id="searchToggle">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Desktop Search Form -->
    <form action="{{ route('shop.search') }}" method="GET" id="desktopSearchForm" class="search-hidden position-absolute w-25 mx-auto px-3 py-2 shadow bg-white rounded d-none d-lg-flex">
        <div class="d-flex">
            <input class="form-control form-control-lg" type="search" name="q" placeholder="Search our products..." required>
            <button class="btn btn-warning btn-lg ms-2 fw-bold" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
</nav>

<!-- Floating Cart
<a href="{{ route('cart.index') }}" 
   id="floating-cart" 
   class="shadow-lg">
    <span class="cart-icon">🛒</span>
    <span class="cart-label">Cart</span>
    <span id="cart-count">
        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
    </span>
</a>

<!-- Styles -->
<style>
/* Top Info Bar */
#top-info-bar {
    position: sticky;
    top: 0;
    z-index: 1100;
}
.top-info-text {
    flex-wrap: wrap;
    overflow-x: auto;
    font-size: 0.75rem;
}
@media (min-width: 768px) {
    .top-info-text { font-size: 0.95rem; }
}

/* Navbar */
#main-navbar {
    position: sticky;
    top: 0; /* dynamically set via JS */
    z-index: 1090;
    margin-top: 0;
}

/* Desktop search form */
#desktopSearchForm {
    top: 100%;
    left: 0;
    right: 0;
}
#desktopSearchForm.search-hidden { display: none !important; }
#desktopSearchForm.search-visible { display: flex !important; }

/* Mobile search */
#mobileSearchForm { display: flex; }
@media (min-width: 992px) { #mobileSearchForm { display: none !important; } }

/* Floating Cart */
#floating-cart {
    position: fixed;
    right: 20px;
    z-index: 1050; /* below navbar */
    background: var(--brand-yellow);
    color: var(--brand-black);
    padding: 8px 16px;
    border-radius: 50px;
    font-weight: bold;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: top 0.2s ease;
}
@media (max-width: 991px) { #floating-cart { right: 10px; } }

/* Cart inner styles */
#floating-cart .cart-icon { font-size: 1.2rem; }
#floating-cart .cart-label { font-weight: bold; }
#cart-count { font-size: 0.8rem; background: var(--brand-red); color: #fff; font-weight: bold; border-radius: 50px; padding: 2px 8px; }
</style>

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Desktop search toggle
    const searchToggle = document.getElementById('searchToggle');
    const desktopSearchForm = document.getElementById('desktopSearchForm');
    if (searchToggle && desktopSearchForm) {
        searchToggle.addEventListener('click', () => {
            desktopSearchForm.classList.toggle('search-hidden');
            desktopSearchForm.classList.toggle('search-visible');
        });
    }

    // Adjust navbar top and floating cart position dynamically
    const topBar = document.getElementById('top-info-bar');
    const navbar = document.getElementById('main-navbar');
    const floatingCart = document.getElementById('floating-cart');
    if(topBar && navbar && floatingCart){
        const totalHeight = topBar.offsetHeight + navbar.offsetHeight + 10; // 10px gap
        navbar.style.top = topBar.offsetHeight + 'px';
        floatingCart.style.top = totalHeight + 'px';
    }
});
</script>

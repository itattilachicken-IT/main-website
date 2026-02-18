<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Attila Chicken')</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://analytics.ahrefs.com/analytics.js" data-key="73ki+E9zAjWbP7Imdb/IvA" async></script>

<style>
/* --------------------------------
   Brand Colors & Fonts
---------------------------------*/
:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
    --navbar-bg: #ffffff;
    --light-gray: #f9f9f9;
}

/* Force Montserrat globally */
body, button, input, select, textarea, h1, h2, h3, h4, h5, h6, a, p, span, li {
    font-family: 'Montserrat', Arial, sans-serif !important;
}

/* Body */
body {
    background-color: #fff;
    color: var(--brand-black);
    line-height: 1.6;
    font-size: 16px;
    font-weight: 400;
}

/* Headings */
h1, h2, h3, h4, h5, h6 {
    font-weight: 700 !important;
    color: var(--brand-black);
    margin-top: 0.8em;
    margin-bottom: 0.4em;
}

/* Buttons */
.btn, .btn-primary, .btn-social, .btn-cart, .btn-search {
    font-family: 'Montserrat', sans-serif !important;
}

/* Links & Nav */
.navbar-nav .nav-link,
.navbar-nav .dropdown-toggle,
.dropdown-menu .dropdown-item {
    font-family: 'Montserrat', sans-serif !important;
    font-weight: 400 !important;
}

/* Inputs & Forms */
input, select, textarea, button {
    font-family: 'Montserrat', sans-serif !important;
}

/* --------------------------------
   Buttons
---------------------------------*/
.btn-primary {
    font-weight: 600;
    background-color: var(--brand-red);
    color: #fff;
    border-radius: 6px;
    padding: 0.75em 1.5em;
    text-transform: uppercase;
    transition: background 0.3s ease;
}
.btn-primary:hover { background-color: #cc0000; }

.btn-social {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
    border-radius: 20px;
    padding: 4px 8px;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease-in-out;
}
.btn-social:hover { background-color: var(--brand-red); color: #fff; }

.btn-cart, .btn-search {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
    border-radius: 25px;
    padding: 6px 18px;
    font-weight: bold;
    transition: 0.2s;
}
.btn-cart:hover, .btn-search:hover { background-color: var(--brand-red); color: #fff; }

/* --------------------------------
   Navbar
---------------------------------*/
.navbar {
    background-color: var(--navbar-bg) !important;
    padding: 0.3rem 1rem;
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 3px 4px rgba(0,0,0,0.1);
}
.navbar-brand img { height: 40px; transition: transform 0.3s ease; }
.navbar-brand:hover img { transform: scale(1.05); }

/* Desktop nav */
@media (min-width: 992px) {
    .navbar-nav .nav-link,
    .navbar-nav .dropdown-toggle {
        color: var(--brand-black) !important;
        font-weight: 400 !important;
        padding: 0.4rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    .navbar-nav .nav-item:hover > .nav-link {
        background-color: var(--brand-red) !important;
        color: #fff !important;
        border-radius: 4px 4px 0 0;
    }
    .navbar-nav .dropdown:hover > .dropdown-menu {
        display: block;
        margin-top: 0;
        background-color: var(--brand-red) !important;
        border-radius: 0 0 4px 4px;
    }
    .navbar-nav .dropdown:hover .dropdown-menu .dropdown-item {
        background-color: var(--brand-red) !important;
        color: #fff !important;
        transition: all 0.2s ease-in-out;
    }
    .navbar-nav .dropdown:hover .dropdown-menu .dropdown-item:hover {
        background-color: #fff !important;
        color: var(--brand-red) !important;
    }
    .navbar-nav .nav-link .nav-main-text {
        font-weight: 700;
        font-size: 1.1rem;
        line-height: 1;
        display: inline-block;
    }
}

/* Mobile nav */
@media (max-width: 991px) {
    .navbar .container { flex-wrap: nowrap; }
    .navbar-nav .nav-item { margin-bottom: 0.25rem; }
    .navbar-nav .nav-link {
        padding: 0.5rem 0.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--brand-black) !important;
        white-space: nowrap;
    }
    .navbar-nav .nav-link:hover { color: var(--brand-red) !important; }
    .navbar-nav .dropdown > .nav-link::after {
        content: '\f0d7';
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        margin-left: 0.5rem;
        font-size: 0.8rem;
    }
    .dropdown-menu { padding-left: 1rem; }
    .dropdown-menu .dropdown-item { padding: 0.4rem 1rem; }
    .navbar-collapse {
        position: fixed; top: 0; right: 0;
        width: 80%; height: 100%;
        background-color: var(--navbar-bg);
        padding: 2rem 1rem;
        overflow-y: auto;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 1040;
    }
    .navbar-collapse.show { transform: translateX(0); }
    .navbar-collapse .close-menu {
        position: absolute;
        top: 1rem; right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
    }
    .nav-link br { display: none !important; }
}

/* --------------------------------
   Search Form
---------------------------------*/
#searchForm {
    position: absolute;
    top: 100%;
    right: 0;
    display: none;
    min-width: 200px;
    z-index: 1000;
    transition: all 0.3s ease;
}
#searchForm.show { display: flex !important; }
.close-menu { display: none; }
@media (max-width: 991px) { .close-menu { display: block; } }

/* --------------------------------
   Footer
---------------------------------*/
footer {
    background: var(--brand-black);
    color: #fff;
    padding: 2rem 0;
    text-align: center;
    margin-top: 2rem;
}
footer a { color: var(--brand-yellow); text-decoration: none; }
footer a:hover { color: var(--brand-red); }

/* --------------------------------
   Cards & CTA
---------------------------------*/
.card:hover { transform: translateY(-5px); transition: 0.3s; }
.contact-cta {
    background: url("../images/contact-bg.jpg") center/cover no-repeat;
    position: relative;
}
.contact-cta::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
}
.contact-cta .container { position: relative; z-index: 2; }

/* --------------------------------
   Responsive Adjustments
---------------------------------*/
@media (max-width: 768px) {
    main { padding-top: 0 !important; padding-bottom: 0 !important; }
    body, html { margin: 0; padding: 0; }
    .hero-banner { margin-top: 0 !important; padding-top: 0 !important; }
}
</style>

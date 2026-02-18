<section class="relative w-full max-h-[350px] overflow-hidden rounded-lg shadow-xl custom-banner">

    {{-- Banner content --}}
    <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 md:px-12 py-16">
        {{-- Main header --}}
        <h1 class="banner-title mb-4">
            ATTILA CHICKEN SHOP MAINTENANCE
        </h1>

        {{-- Body text --}}
        <p class="banner-body max-w-3xl">
            To ensure we serve you better, our online ordering system is temporarily unavailable while we perform essential shop maintenance.
        </p>

        {{-- Instructions --}}
        <p class="banner-instructions max-w-3xl mt-4">
            In the meantime, please use our <a href="https://attilachicken.com/#contact" target="_blank" rel="noopener noreferrer">contact form</a> or email <a href="mailto:orders@attilachicken.com">orders@attilachicken.com</a> to place your order.
        </p>

        {{-- Footer badge --}}
        <div class="mt-6">
            <span class="banner-badge">
                TEMPORARY ONLINE SHOP CLOSURE
            </span>
        </div>

        {{-- Back to Home button --}}
        <div class="mt-4">
            <a href="{{ url('/') }}" class="back-home-btn">
                BACK TO HOME
            </a>
        </div>
    </div>

    {{-- Decorative shapes --}}
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    {{-- Custom CSS --}}
    <style>
        :root {
            --brand-red: #fe0000;
            --brand-yellow: #ffc600;
            --brand-black: #000000;
        }

        /* Banner background */
        .custom-banner {
            background-color: #ffffff; /* white background */
            position: relative;
            overflow: hidden;
            color: var(--brand-black);
        }

        /* Decorative shapes */
        .custom-banner .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            pointer-events: none; /* important for clickable links on mobile */
        }
        .shape-1 { width: 300px; height: 300px; background-color: var(--brand-yellow); top: -100px; left: -100px; }
        .shape-2 { width: 400px; height: 400px; background-color: var(--brand-red); bottom: -150px; right: -150px; }
        .shape-3 { width: 250px; height: 250px; background-color: var(--brand-black); top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.05; }

        /* Header */
        .banner-title {
            font-size: 2rem;
            font-weight: 900;
            color: var(--brand-red);
            text-shadow: 2px 2px 6px rgba(0,0,0,0.2);
            animation: fade-in-down 0.8s ease-out forwards;
        }

        /* Body text */
        .banner-body {
            font-size: 1.5rem;
            color: var(--brand-black);
            margin-top: 0.5rem;
            line-height: 1.5rem;
            animation: fade-in-up 1s ease-out forwards;
        }

        /* Instructions links */
        .banner-instructions {
            font-size: 1.1rem;
            color: var(--brand-black);
            margin-top: 0.5rem;
            line-height: 1.4rem;
            animation: fade-in-up 1.2s ease-out forwards;
        }
        .banner-instructions a {
            color: var(--brand-yellow);
            font-weight: 600;
            text-decoration: underline;
        }
        .banner-instructions a:hover { text-decoration: none; }

        /* Footer badge */
        .banner-badge {
            display: inline-block;
            background-color: var(--brand-red);
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
            animation: fade-in-up 1.4s ease-out forwards;
        }

        /* Back to Home button */
        .back-home-btn {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.5rem 1.5rem;
            background-color: var(--brand-black);
            color: var(--brand-yellow);
            font-weight: 700;
            border-radius: 9999px;
            text-decoration: none;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .back-home-btn:hover {
            background-color: var(--brand-red);
            color: #fff;
        }

        /* Animations */
        @keyframes fade-in-down { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Responsive */
        @media (min-width: 768px) {
            .banner-title { font-size: 3rem; }
            .banner-body { font-size: 1.125rem; }
            .banner-instructions { font-size: 1rem; }
        }
    </style>
</section>

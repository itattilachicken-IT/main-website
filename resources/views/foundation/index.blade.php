@extends('layouts.app')

@section('title', 'Attila Cares – CSR Program')

@section('styles')
<style>
:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
    --navbar-bg: #ffffff;
    --light-gray: #f9f9f9;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Logo */
.foundation-logo {
    text-align: center;
    margin: 40px 0;
}

.foundation-logo img {
    max-width: 220px;
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: transform .3s ease;
}

.foundation-logo img:hover {
    transform: scale(1.05);
}

/* Sections */
.foundation-section {
    padding: 50px 0;
}

.foundation-section h2 {
    color: var(--brand-red);
    margin-bottom: 20px;
    font-weight: 700;
}

.foundation-section p {
    line-height: 1.7;
    font-size: 1.1rem;
}

.foundation-list {
    margin-top: 20px;
}

.foundation-list li {
    margin-bottom: 12px;
    line-height: 1.6;
    font-size: 1.05rem;
}

/* CTA */
.foundation-cta {
    background-color: var(--brand-red);
    color: #fff;
    padding: 12px 30px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background .3s;
}

.foundation-cta:hover {
    background-color: #c40000;
}

/* Responsive */
@media (max-width: 768px) {
    .carousel-inner h1 {
        font-size: 1.8rem;
    }
    .carousel-inner p {
        font-size: 1rem;
    }
}
</style>
@endsection

@section('content')
<div class="container">

    {{-- HERO SLIDER --}}
   <section id="hero-slider" class="py-2 text-white rounded-4 mt-2" style="background-color: #fe0000;">
        <div id="foundationCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#foundationCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#foundationCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#foundationCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner text-center py-4">

               {{-- SLIDE 1: Attila Cares --}}
    <div class="carousel-item active">
        <h1 class="fw-bold display-5">✨ Attila Cares</h1>
        <p class="lead mt-3">
            Our promise to uplift and empower communities across Kenya.
        </p>
    </div>

    {{-- SLIDE 2: Our Commitment to Communities --}}
    <div class="carousel-item">
        <h1 class="fw-bold display-5">🤝 Our Commitment to Communities</h1>
        <p class="lead mt-3">
            We invest in farmers, families, youth, and women to build a better future.
        </p>
    </div>


                <div class="carousel-item">
                    <h1 class="fw-bold display-5">🌱 Empowering Farmers & Families</h1>
                    <p class="lead mt-3">Training, resources, and opportunities for farmers, youth, and women.</p>
                </div>

                <div class="carousel-item">
                    <h1 class="fw-bold display-5">🌍 Sustainability, Nutrition & Growth</h1>
                    <p class="lead mt-3">We champion clean farming, environmental action, and food safety.</p>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#foundationCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#foundationCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
            </button>

        </div>
    </section>

   {{-- LOGO & INTRO SECTION SIDE BY SIDE --}}
<section class="foundation-section py-2">
    <div class="row align-items-center">
        
         {{-- TEXT COLUMN --}}
        <div class="col-md-7">
            <h2>✨ Attila Cares – Our Commitment to Communities</h2>
            <p>
                At Attila, we believe business must improve lives. Our CSR program,
                <strong>Attila Cares</strong>, supports farmers, protects the environment,
                and brings quality nutrition to families across Kenya.
            </p>
        </div>

        {{-- IMAGE COLUMN --}}
        <div class="col-md-5 text-center mb-2 mb-md-0">
            <img src="{{ asset('images/attilachickenfoundation.jpg') }}"
                 alt="Attila Cares Logo"
                 class="img-fluid rounded shadow"
                 style="max-width: 80%; height: auto;">
        </div>

       

    </div>
</section>


    <section class="foundation-section bg-light rounded-4">
        <h2>🌱 1. Community Empowerment</h2>
        <p>
            We invest in people. Through the <strong>Attila Poultry Academy</strong>, we train farmers, support youth
            and women in agribusiness, and provide poultry starter kits for promising entrepreneurs.
        </p>
    </section>

    <section class="foundation-section">
        <h2>🐓 2. Sustainable & Humane Poultry Farming</h2>
        <p>
            We champion clean, ethical, and humane farming. Our commitment includes food safety education, responsible
            production practices, and transparent communication to eliminate myths around broiler chicken.
        </p>
    </section>

    <section class="foundation-section bg-light rounded-4">
        <h2>🌍 3. Environmental Responsibility</h2>
        <p>Attila actively promotes sustainability through:</p>
        <ul class="foundation-list">
            <li>Tree planting drives</li>
            <li>Clean waste management</li>
            <li>Water-saving systems</li>
            <li>Recycling programs in our fast-food outlets</li>
        </ul>
    </section>

    <section class="foundation-section">
        <h2>👩‍🎓 4. Youth & Women Empowerment</h2>
        <p>
            We open doors for the next generation. Our franchise empowerment paths, internships, and mentorship
            programs help young people and women build lasting businesses.
        </p>
    </section>

    <section class="foundation-section bg-light rounded-4">
        <h2>🍗 5. Nutrition & Food Safety</h2>
        <p>
            We support communities with affordable protein and clean food education. We partner with schools, NGOs,
            and local programs to fight malnutrition and promote healthy eating.
        </p>
    </section>

    <section class="foundation-section text-center">
        <h2>🤝 Partnerships</h2>
        <p>
            Our impact grows through collaborations with banks, feed companies, county governments, NGOs, and community groups.
        </p>

        <h3 class="mt-4 fw-bold text-danger">❤ Attila Cares</h3>
        <p>
            We are more than a poultry company. We are partners in growth, nutrition, empowerment, and sustainability.
            Together, we build healthier communities.
        </p>
    </section>

</div>
@endsection

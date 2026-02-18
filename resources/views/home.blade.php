@extends('layouts.app')

@section('title', 'Welcome to Attila Chicken')

@section('content')

<!-- HERO SLIDER -->
<section class="hero-banner">
  <div class="hero-slides">

    <!-- Slide 1 -->
    <div class="hero-slide">
      <div class="hero-image-wrapper">
        <img src="{{ asset('images/attilawebbanner.jpg') }}" alt="Slide 1">
        <div class="hero-image-buttons">
          <a href="#about-us" class="btn btn-danger">Learn More</a>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="hero-slide">
      <div class="hero-image-wrapper">
        <img src="{{ asset('images/attilashopd.png') }}" alt="Slide 2">
        <div class="hero-image-buttons">
          <a href="#products" class="btn btn-warning">Order Now</a>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="hero-slide">
      <div class="hero-image-wrapper">
        <img src="{{ asset('images/henvestbanner.png') }}" alt="Slide 3">
        <div class="hero-image-buttons">
          <a href="#services" class="btn btn-success">Invest Today</a>
        </div>
      </div>
    </div>

    <!-- Slide 4 -->
    <div class="hero-slide">
      <div class="hero-image-wrapper">
        <img src="{{ asset('images/franchisebannerd.png') }}" alt="Slide 4">
        <div class="hero-image-buttons">
          <a href="#services" class="btn btn-danger">Partner With Us</a>
        </div>
      </div>
    </div>

  </div>

  <!-- Navigation -->
  <div class="hero-nav">
    <span class="prev">&#10094;</span>
    <span class="next">&#10095;</span>
  </div>
</section>

<!-- HERO SLIDER CSS -->
<style>
.hero-banner {
  width: 100%;
  overflow: hidden;
  margin: 0;
}

.hero-slides {
  display: flex;
  transition: transform 0.8s ease-in-out;
}

.hero-slide {
  flex: 0 0 100%;
}

.hero-image-wrapper {
  position: relative;
  width: 100%;
  /* Desktop: taller hero */
  height: 65vh;
  min-height: 300px;
  background: #000;
}

.hero-image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* never crop */
  object-position: center;
  display: block;
}

.hero-image-wrapper::after {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
  z-index: 1;
}

.hero-image-buttons {
  position: absolute;
  left: 50%;
  bottom: 6%;
  transform: translateX(-50%);
  display: flex;
  gap: 0.75rem;
  z-index: 2;
}

.hero-image-buttons .btn {
  padding: 0.75rem 1.6rem;
  font-size: clamp(0.9rem, 2vw, 1.1rem);
  background: rgba(0,0,0,0.6) !important;
  color: #fff !important;
  border-radius: 6px;
  border: none;
}

/* TABLET */
@media (max-width: 991px) {
  .hero-image-wrapper {
    height: 50vh; /* shorter, keeps full image visible */
  }
}

/* MOBILE */
@media (max-width: 576px) {
  .hero-image-wrapper {
    height: 35vh; /* shorter for phones */
  }

  .hero-image-buttons {
    bottom: 12%;
    flex-direction: column;
    width: 90%;
  }

  .hero-image-buttons .btn {
    width: 100%;
    text-align: center;
  }
}

/* Navigation arrows */
.hero-nav span {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: clamp(1.5rem, 4vw, 2.5rem);
  color: #fff;
  cursor: pointer;
  padding: 8px 12px;
  z-index: 5;
  user-select: none;
}

.hero-nav .prev { left: 10px; }
.hero-nav .next { right: 10px; }
</style>

<!-- HERO SLIDER JS -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('.hero-slide');
  const slider = document.querySelector('.hero-slides');
  const next = document.querySelector('.next');
  const prev = document.querySelector('.prev');

  let index = 0;
  let interval;

  function updateSlide() {
    slider.style.transform = `translateX(-${index * 100}%)`;
    resetInterval();
  }

  function nextSlide() {
    index = (index + 1) % slides.length;
    updateSlide();
  }

  function prevSlide() {
    index = (index - 1 + slides.length) % slides.length;
    updateSlide();
  }

  function startInterval() {
    interval = setInterval(nextSlide, 8000);
  }

  function resetInterval() {
    clearInterval(interval);
    startInterval();
  }

  next.addEventListener('click', nextSlide);
  prev.addEventListener('click', prevSlide);

  startInterval();
});
</script>



{{-- About Us Section --}}
    @include('partials.about')
    
<!-- Featured Products Slider -->
<section id="products" class="container bg-white py-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Our Chicken Products</h2>
    </div>

    @if($featuredProducts->count())
    <div id="productsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($featuredProducts->chunk(4) as $chunkIndex => $productChunk)
            <div class="carousel-item @if($chunkIndex == 0) active @endif">
                <div class="row g-2 justify-content-center">
                    @foreach($productChunk as $product)
                    <div class="col-6 col-md-3">
                        <div class="card h-100 text-center shadow-sm">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top" 
                                 alt="Attila {{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">Attila {{ $product->name }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        {{-- Carousel controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Button below slider to visit the shop --}}
    <div class="text-center mt-3">
        <a href="{{ route('shop.index') }}" class="btn btn-danger btn-lg fw-bold">
            View All Products
        </a>
    </div>
    @else
        <p class="text-muted">No featured products available at the moment.</p>
    @endif
</section>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const carouselEl = document.getElementById('productsCarousel');
    new bootstrap.Carousel(carouselEl, {
        interval: 4000,
        ride: 'carousel'
    });
});
</script>

    
<!-- Investment & Franchise Opportunities Section -->
<section id="services" class="py-2">
    <div class="container px-4">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Investment Plans & Franchise Opportunities</h2>
            <p class="text-dark mb-0">
                Attila Chicken offers lucrative investment opportunities and franchise partnerships for ambitious entrepreneurs 
                and investors. Join us to grow with a trusted agricultural brand and become part of a nationwide network delivering premium poultry products.
            </p>
        </div>

        <!-- Cards Row -->
        <div class="row g-4 justify-content-center">
            <!-- Investment Plans Card -->
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-img-wrapper overflow-hidden">
                        <img src="{{ asset('images/newinvestmentplan.jpg') }}" 
                             class="card-img-top img-fluid" 
                             alt="Investment Plans" 
                             style="height: 300px; object-fit: cover; width: 100%;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Excellent Investment Plans</h5>
                        <p class="card-text mb-3">
                            Partner with Attila Chicken and access passive, profitable, sustainable investment opportunities within our 
                            poultry farming operations.
                        </p>
                        <a href="{{ url('/investments') }}" class="btn btn-danger btn-sm">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Franchise Opportunities Card -->
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-img-wrapper overflow-hidden">
                        <img src="{{ asset('images/franchises.png') }}" 
                             class="card-img-top img-fluid" 
                             alt="Franchise Opportunities" 
                             style="height: 300px; object-fit: cover; width: 100%;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Franchise Opportunities</h5>
                        <p class="card-text mb-3">
                            Join our expanding network and become an Attila Chicken franchise partner, tapping into a growing 
                            national market with proven support and training.
                        </p>
                        <a href="{{ url('/franchise') }}" class="btn btn-danger btn-sm">Partner With Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Optional: add smooth hover effect on cards */
.card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

/* Ensure images never exceed max height on desktops */
@media (min-width: 992px) {
    .card-img-wrapper img {
        height: 300px;
    }
}

/* Mobile adjustments */
@media (max-width: 767px) {
    .card-img-wrapper img {
        height: 200px;
    }
    .card-body .btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }
}
</style>


<!-- About Us -->
<section id="about" class="bg-light py-2">
    <div class="container text-center">
        <h2 class="fw-bold mb-2">About Attila Chicken</h2>
<p class="mb-2">
    Attila Chicken began with a simple vision: to provide families in Kenya with fresh, high-quality poultry products while promoting sustainable farming practices. 
    Over the years, we have grown into a trusted name in the agricultural sector, combining modern farming techniques with a commitment to animal welfare and environmental responsibility.
</p>
<p class="mb-2">
    Our journey is driven by a passion for quality, innovation, and community empowerment. We offer not only farm-fresh chicken but also 
    profitable investment opportunities and franchise programs, allowing entrepreneurs to join us in building a stronger, more sustainable poultry industry nationwide.
</p>
<p class="mb-2">
    Today, Attila Chicken represents more than just poultry products—it stands for trust, integrity, and a dedication to improving the lives of our customers, partners, and communities. 
    Every product, every partnership, and every investment reflects our core belief: quality, health, and affordability can go hand-in-hand with social and environmental responsibility.
</p>

                <!-- Mission, Vision & Core Values -->
        <div class="row mt-2 text-center">
            <!-- Mission -->
            <div class="col-md-4 mb-2">
                <div class="p-2 bg-light rounded shadow h-100">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bi bi-bullseye text-danger fs-2 mb-2"></i>
                        <h5 class="mb-2">Mission</h5>
                    </div>
                    <p>To nurture high quality poultry through responsible farming practices delivering fresh, healthy products that meet the needs of every customer.</p>
                </div>
            </div>
            <!-- Vision -->
            <div class="col-md-4 mb-2">
                <div class="p-2 bg-light rounded shadow h-100">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bi bi-eye text-danger fs-2 mb-2"></i>
                        <h5 class="mb-2">Vision</h5>
                    </div>
                    <p>To be a leading provider of quality poultry products trusted for our integrity, sustainability and customer focus.</p>
                </div>
            </div>
            <!-- Core Values -->
<div class="col-md-4 mb-2">
    <div class="p-3 bg-light rounded shadow h-100">
        <div class="d-flex flex-column align-items-center">
            <i class="bi bi-stars text-danger fs-2 mb-2"></i>
            <h5 class="mb-2">Core Values</h5>
        </div>
        <ul class="row list-unstyled text-start mb-0">
            <li class="col-6 mb-1"><i class="bi bi-check-circle-fill text-danger me-2"></i> Quality</li>
            <li class="col-6 mb-1"><i class="bi bi-check-circle-fill text-danger me-2"></i> Innovation</li>
            <li class="col-6 mb-1"><i class="bi bi-check-circle-fill text-danger me-2"></i> Customer First</li>
            <li class="col-6 mb-1"><i class="bi bi-check-circle-fill text-danger me-2"></i> Integrity</li>
            <li class="col-6 mb-1"><i class="bi bi-check-circle-fill text-danger me-2"></i> Sustainability</li>
        </ul>
    </div>
</div>


        </div>
<a href="{{ route('about') }}" class="btn btn-danger">Learn More</a>

    </div>
</section>



<!-- Our Farm Section -->
<section id="farm" class="py-2" id="our-farm">
    <div class="container text-center text-lg-start">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="fw-bold mb-3">Our Farm in Kimana, Oloitoktok</h2>
                <p class="mb-3">
                    At Attila Chicken, our farm in Kimana, Oloitoktok embodies sustainable poultry farming and premium-quality production. 
                    We combine organic feed, eco-friendly housing, and humane practices to deliver healthy, nutritious poultry products to our customers.
                </p>
                <p class="mb-3">
                    Beyond production, our farm is a hub for innovation and community empowerment. 
                    We provide franchise and investment opportunities while engaging local communities through training and educational initiatives.
                </p>
                <p class="mb-0">
                    Learn more about how we cultivate quality, sustainability, and growth in every aspect of our farm operations.
                </p>
                <a href="{{ url('/our-farm') }}" class="btn btn-danger btn-lg mt-3">Read More</a>
            </div>
        </div>
    </div>
</section>

<style>
@media (max-width: 992px) {
    #our-farm {
        text-align: center;
    }
}
</style>


<!-- Contact CTA -->
<!-- Contact Us Section -->
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

<section id="contact" class="py-2 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-2">Contact Us</h2>
                <p class="text-dark">
    Have questions, inquiries, partnership ideas, or want to place an order for our premium chicken products online? Reach out to us and our team will get back to you shortly.
</p>


            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-2">
                    <div class="card-body p-2">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+254 700 000 000" required>
                                </div>

                               <!-- Subject -->
<div class="col-md-6">
    <label for="subject" class="form-label fw-bold">Subject</label>
    <select class="form-select" id="subject" name="subject" required>
        <option value="">-- Select a Subject --</option>
        <option value="General Inquiries">General Inquiries</option>
        <option value="Place an Order">Place an Order</option>
        <option value="Investment Plans">Investment Plans</option>
        <option value="Franchise Network">Franchise Network</option>
    </select>
</div>


                                <!-- Message -->
                                <div class="col-12">
                                    <label for="message" class="form-label fw-bold">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
                                </div>

                                <!-- Submit -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger btn-lg fw-bold mt-2">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

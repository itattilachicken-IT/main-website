{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')
<!-- Our Story Section -->
<section class="py-2">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Column -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Our Story</h2>
                <p class="mb-4">
                    Attila Chicken began with a simple vision: to provide families in Kenya with fresh, high-quality poultry products while promoting sustainable farming practices. 
                    Over the years, we have grown into a trusted name in the agricultural sector, combining modern farming techniques with a commitment to animal welfare and environmental responsibility.
                </p>
                <p class="mb-4">
                    Our journey is driven by a passion for quality, innovation, and community empowerment. We offer not only farm-fresh chicken but also 
                    profitable investment opportunities and franchise programs, allowing entrepreneurs to join us in building a stronger, more sustainable poultry industry nationwide.
                </p>
                <p class="mb-4">
                    Today, Attila Chicken represents more than just poultry products—it stands for trust, integrity, and a dedication to improving the lives of our customers, partners, and communities. 
                    Every product, every partnership, and every investment reflects our core belief: quality, health, and affordability can go hand-in-hand with social and environmental responsibility.
                </p>
            </div>

<!-- Media Column: Full-width Slideshow -->
<div class="col-lg-6 mb-4 mb-lg-0">
    <div id="pageGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach(['gallery1.jpg','gallery2.jpg','gallery3.jpg','gallery4.jpg','gallery5.jpg'] as $index => $image)
            <div class="carousel-item @if($index == 0) active @endif">
                <img src="{{ asset('images/'.$image) }}" 
                     class="d-block w-100 rounded shadow slideshow-img" 
                     alt="Gallery Image {{ $index + 1 }}"
                     style="cursor:pointer;"
                     data-bs-toggle="modal" 
                     data-bs-target="#galleryModal"
                     data-slide="{{ $index }}">
            </div>
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#pageGalleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#pageGalleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Modal for Clicking Slideshow Images -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0">
        <div id="carouselGalleryModal" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach(['gallery1.jpg','gallery2.jpg','gallery3.jpg','gallery4.jpg','gallery5.jpg'] as $index => $image)
                <div class="carousel-item @if($index==0) active @endif">
                    <img src="{{ asset('images/'.$image) }}" class="d-block w-100 modal-slide-img" alt="Gallery Image {{ $index + 1 }}">
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselGalleryModal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselGalleryModal" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
      </div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"></button>
    </div>
  </div>
</div>

<!-- JS to sync modal carousel with clicked slide -->
<script>
const slideshowImages = document.querySelectorAll('#pageGalleryCarousel .carousel-item img');
const modalCarousel = document.getElementById('carouselGalleryModal');

slideshowImages.forEach((img, index) => {
    img.addEventListener('click', () => {
        const carouselInstance = bootstrap.Carousel.getInstance(modalCarousel) || new bootstrap.Carousel(modalCarousel, {
            interval: 3000,
            ride: 'carousel'
        });
        carouselInstance.to(index);
    });
});
</script>

<!-- CSS for consistent sizing -->
<style>
.slideshow-img, .modal-slide-img {
    height: 400px; /* adjust to your preferred slide height */
    object-fit: cover; /* fill the container without stretching */
    width: 100%;
}
@media (max-width: 768px) {
    .slideshow-img, .modal-slide-img {
        height: 250px; /* smaller height on mobile */
    }
}
</style>


        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Core Values Card -->
            <div class="col-md-4 mb-3">
                <div class="p-3 bg-white rounded shadow h-100">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bi bi-stars text-danger fs-2 mb-3"></i>
                        <h5 class="mb-3">Core Values</h5>
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

            <!-- Highlights Card -->
            <div class="col-md-8 mb-3">
                <div class="p-3 bg-white rounded shadow h-100">
                    <h5 class="fw-bold mb-3">Why Choose Attila Chicken</h5>
                    <ul class="row list-unstyled mb-0">
                        <li class="col-md-6 mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Trusted source of premium, organic chicken</li>
                        <li class="col-md-6 mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Farming practices rooted in sustainability</li>
                        <li class="col-md-6 mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> Opportunities for investors & entrepreneurs</li>
                        <li class="col-md-6 mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i> A growing national network of franchises</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3">Contact Us</h2>
                <p class="text-dark">
                    Have questions, inquiries, partnership ideas, or want to place an order for our premium chicken products online? 
                    Reach out to us and our team will get back to you shortly.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-3">
                    <div class="card-body p-4">
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+254 700 000 000" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label fw-bold">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="What is this about?" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label fw-bold">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger btn-lg fw-bold mt-3">Send Message</button>
                                </div>
                            </div>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

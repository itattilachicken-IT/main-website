{{-- resources/views/farm.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="row align-items-start">

        <!-- Farm Text Section (Left Column) -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-4">Our Farm in Kimana, Oloitoktok</h2>
            <p>
                Nestled in the picturesque region of Kimana, Oloitoktok, Attila Chicken’s farm is a model of sustainable poultry production. 
                Our farm benefits from clean water, healthy climate, and natural environment that enhance poultry health and growth.
            </p>
            <p>
                We use organic feed, eco-friendly housing, and humane practices to ensure high-quality, nutritious poultry. 
                Every product undergoes strict quality control for premium health and safety standards.
            </p>
            <p>
                Beyond production, the farm engages the community through educational visits, training, and awareness programs. 
                Franchise and investment opportunities are also available nationwide.
            </p>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>Organic feed and sustainable farming practices</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>High-quality poultry products</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>Franchise & investment opportunities</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-danger me-2"></i>Community engagement and farm education</li>
            </ul>
            <a href="{{ url('/#contact') }}" class="btn btn-danger">Contact Us</a>

        </div>

        <!-- Farm Gallery Section (Right Column) -->
        <div class="col-lg-6">
            <div id="farmGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach(['gallery1.jpg','gallery2.jpg','gallery3.jpg','gallery4.jpg','gallery5.jpg'] as $index => $image)
                    <div class="carousel-item @if($index==0) active @endif">
                        <img src="{{ asset('images/'.$image) }}" 
                             class="d-block w-100 rounded shadow farm-slide-img" 
                             alt="Farm Image {{ $index + 1 }}"
                             style="cursor:pointer;"
                             data-bs-toggle="modal" 
                             data-bs-target="#farmModal"
                             data-slide="{{ $index }}">
                    </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#farmGalleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#farmGalleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

    </div>

</div>

<!-- Modal for Farm Images -->
<div class="modal fade" id="farmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body p-0">
        <div id="farmCarouselModal" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach(['farm1.jpg','farm2.jpg','farm3.jpg','farm4.jpg','farm5.jpg'] as $index => $image)
                <div class="carousel-item @if($index==0) active @endif">
                    <img src="{{ asset('images/'.$image) }}" class="d-block w-100 modal-farm-img" alt="Farm Image {{ $index + 1 }}">
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#farmCarouselModal" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#farmCarouselModal" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
      </div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"></button>
    </div>
  </div>
</div>

<!-- JS to open modal slideshow when clicking an image -->
<script>
const farmSlides = document.querySelectorAll('#farmGalleryCarousel .carousel-item img');
const farmModalCarousel = document.getElementById('farmCarouselModal');

farmSlides.forEach((img, index) => {
    img.addEventListener('click', () => {
        const carouselInstance = bootstrap.Carousel.getInstance(farmModalCarousel) || new bootstrap.Carousel(farmModalCarousel, {
            interval: 3000,
            ride: 'carousel'
        });
        carouselInstance.to(index);
    });
});
</script>

<!-- CSS for consistent sizing -->
<style>
.farm-slide-img, .modal-farm-img {
    height: 400px;
    object-fit: cover;
    width: 100%;
}
@media (max-width: 992px) {
    .farm-slide-img, .modal-farm-img {
        height: 300px;
    }
}
@media (max-width: 768px) {
    .row.align-items-start {
        flex-direction: column-reverse; /* Gallery below text on small screens */
    }
    .farm-slide-img, .modal-farm-img {
        height: 250px;
    }
}
</style>
@endsection

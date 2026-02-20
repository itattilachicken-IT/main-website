<!-- Footer -->
<footer class="bg-black text-warning py-4">
    <div class="container">

<!-- Quick Links Row -->
<div class="row mb-4">
    <div class="col-12">
        <h5 class="fw-bold text-white mb-3">Quick Links</h5>

        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-3 col-6 mb-2">
                <ul class="list-unstyled">
                    <li><a href="{{ url('/about-us') }}" class="text-warning text-decoration-none">About Us</a></li>
                    <li><a href="{{ url('/investments') }}" class="text-warning text-decoration-none">Investments</a></li>
                    <li><a href="{{ url('/franchise') }}" class="text-warning text-decoration-none">Franchise</a></li>
                    <li><a href="{{ url('/#contact') }}" class="text-warning text-decoration-none">Contact Us</a></li>
                    <li><a href="{{ route('recipes') }}" class="text-warning text-decoration-none">Recipes</a></li>
                    <li><a href="{{ route('chicken-blog') }}" class="text-warning text-decoration-none">Our Cooking Blog</a></li>
                    <li><a href="{{ route('growth-plan') }}" class="text-warning text-decoration-none">
            Attila Growth Plan
        </a></li>
        
       <li><a href="{{ route('refund.policy') }}">Refund & Returns Policy</a>
</li>

                    
                </ul>
            </div>

           

            <!-- Column 3 -->
            <div class="col-md-3 col-6 mb-2">
                <ul class="list-unstyled">
                    <li><a href="{{ route('farm.breederOperations') }}" class="text-warning text-decoration-none">Breeder Operations</a></li>
                    <li><a href="{{ route('farm.hatchery') }}" class="text-warning text-decoration-none">Hatchery</a></li>
                    <li><a href="{{ route('farm.housing') }}" class="text-warning text-decoration-none">Housing</a></li>
                    <li><a href="{{ route('farm.feed') }}" class="text-warning text-decoration-none">Feed</a></li>
                    <li><a href="{{ route('farm.transportation') }}" class="text-warning text-decoration-none">Transportation</a></li>
                    <li><a href="{{ route('farm.processingPackaging') }}" class="text-warning text-decoration-none">Processing & Packaging</a></li>
                    <li><a href="{{ route('safehandling') }}" class="text-warning text-decoration-none">Safe Handling & Preparation</a></li>
                    <li><a href="{{ route('foundation.index') }}" class="text-warning text-decoration-none">Attila CSR</a></li>
                    
                </ul>
            </div>

            <!-- Column 4 -->
            <div class="col-md-3 col-6 mb-2">
                <ul class="list-unstyled">
                    
                    <li><a href="/our-standards/animal-welfare" class="text-warning text-decoration-none">Animal Welfare</a></li>
                    <li><a href="/our-standards/food-safety" class="text-warning text-decoration-none">Food Safety</a></li>
                    <li><a href="/our-standards/humane-practices" class="text-warning text-decoration-none">Humane Practices</a></li>
                    <li><a href="/our-standards/quality-standards" class="text-warning text-decoration-none">Quality Standards</a></li>
                    <li><a href="/our-standards/sustainability" class="text-warning text-decoration-none">Sustainability</a></li>
                    <li><a href="/our-standards/nutrition" class="text-warning text-decoration-none">Nutrition</a></li>
                    <li><a href="/news/press-releases" class="text-warning text-decoration-none">Truths</a></li>
                    <li><a href="/news/awards" class="text-warning text-decoration-none">FAQs</a></li>
                    
                </ul>
            </div>
             <!-- Column 2 -->
            <div class="col-md-3 col-6 mb-2">
    <ul class="list-unstyled">
        @foreach($navbarProducts->take(7) as $navProduct)
            <li>
                <a href="{{ route('shop.show', $navProduct->slug) }}" class="text-warning text-decoration-none">
                    {{ $navProduct->name }}
                </a>
            </li>
        @endforeach

        @if($navbarProducts->count() > 7)
            <li>
                <a href="{{ route('shop.index') }}" class="text-danger text-decoration-none fw-bold">
                    View All
                </a>
            </li>
        @endif

        
                
           
    </ul>
    <a href="{{ route('investors.login') }}" class="text-decoration-none fw-bold" style="color: white; background-color: #fe0000; padding: 5px 10px; border-radius: 5px;">
                    Investors
                </a>
</div>



        </div>
    </div>
</div>


       <!-- Footer Main Row: Company Name + Full Location + Social Icons -->
<div class="row mb-4 justify-content-between align-items-center">

    <!-- Column 1: Company Name + Full Address -->
    <div class="col-md-4 mb-3 d-flex flex-column">
        <div class="d-flex align-items-center gap-2 mb-1">
            <h5 class="fw-bold text-white mb-0">Attila Chicken Location</h5>
        </div>
        <div class="d-flex align-items-center text-warning gap-3">
    <i class="bi bi-geo-alt-fill me-2"></i>
    <span>T-PLAZA, 4th Floor, Thika, Kenya</span>
   

    <!-- Google Map iframe -->
    <iframe 
        src="https://www.google.com/maps?q=T-PLAZA,+Thika,+Kenya&output=embed" 
        width="200" 
        height="100" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>

</div>


    </div>

    <!-- Column 2: Social Icons -->
    <div class="col-md-4 mb-3 d-flex flex-column align-items-center">
        <h5 class="fw-bold text-white text-center mb-2">Follow Us</h5>
        <div class="d-flex gap-3">
            <a href="https://www.facebook.com/AttilaChicken" target="_blank" class="text-warning"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/attiladachicken" target="_blank" class="text-warning"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/@attilafarms" target="_blank" class="text-warning"><i class="bi bi-tiktok"></i></a>
            <a href="https://youtube.com/@attiladachicken?si=4htNcFFr6yvsyDLA" target="_blank" class="text-warning"><i class="bi bi-youtube"></i></a>
        </div>
    </div>

</div>



        <hr class="bg-warning">

        <div class="text-center small">
            &copy; {{ date('Y') }} Attila Chicken. All rights reserved. 
            
        </div>

    </div>
</footer>

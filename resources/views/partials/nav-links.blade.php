<div class="collapse navbar-collapse" id="navbarNav">
    <!-- Close button (mobile only) -->
    <button type="button" class="close-menu btn btn-link">&times;</button>

    <ul class="navbar-nav ms-auto">
        
        
        <!-- Our Story -->
<li class="nav-item">
  <a class="nav-link d-flex align-items-center" href="{{ url('/') }}">
    <span class="nav-main-text">Home</span></span>
    <span class="d-inline d-lg-none">Home</span>
  </a>
</li>
        <!-- Our Story -->
<li class="nav-item">
  <a class="nav-link d-flex align-items-center" href="{{ url('/') }}#about">
    <span class="nav-main-text">Our <span class="nav-main-text">Story</span></span>
    <span class="d-inline d-lg-none">Our Story</span>
  </a>
</li>


        <!-- Our Farm -->
<li class="nav-item dropdown">
    <!-- Main link scrolls to #farm -->
    <a class="nav-link d-flex justify-content-between align-items-center" href="{{ url('/') }}#farm">
        <span class="nav-main-text">Our <span class="nav-main-text">Farm</span></span>
        <span class="d-inline d-lg-none">Our Farm</span>
    </a>
    
    <!-- 
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('farm.breederOperations') }}">Breeder Operations</a></li>
        <li><a class="dropdown-item" href="{{ route('farm.hatchery') }}">Hatchery</a></li>
        <li><a class="dropdown-item" href="{{ route('farm.housing') }}">Housing</a></li>
        <li><a class="dropdown-item" href="{{ route('farm.feed') }}">Feed</a></li>
        <li><a class="dropdown-item" href="{{ route('farm.transportation') }}">Transportation</a></li>
        <li><a class="dropdown-item" href="{{ route('farm.processingPackaging') }}">Processing & Packaging</a></li>
    </ul>
</li>



       <!-- 
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" 
       href="#" 
       id="chickenDropdown" 
       role="button"
       data-bs-toggle="dropdown" 
       aria-expanded="false">
       
        {{-- Desktop text (stacked) --}}
        <span class="d-none d-lg-inline">
            Our<br>
            <span class="nav-main-text">Chicken</span>
        </span>

        {{-- Mobile text (inline) --}}
        <span class="d-inline d-lg-none">Our Chicken</span>
    </a>

    <ul class="dropdown-menu" aria-labelledby="chickenDropdown">
        <li>
            <a class="dropdown-item fw-bold" href="{{ route('shop.index') }}">
                All Products
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>

        @foreach($navbarProducts as $navProduct)
    <li>
        <a class="dropdown-item" href="{{ route('shop.show', $navProduct->slug) }}">
            {{ $navProduct->name }}
        </a>
    </li>
@endforeach

    </ul>
</li>


<!-- Franchise / Investment Plans -->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="{{ url('/#services') }}">
        <span class="nav-main-text">Investment <span class="nav-main-text">Plans</span></span>
        <span class="d-inline d-lg-none">Investment Plans</span>
    </a>
</li>



        <!-- Franchise -->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="{{ url('/#services') }}">
        <span class="nav-main-text">Our <span class="nav-main-text">Franchise</span></span>
        <span class="d-inline d-lg-none">Our Franchise</span>
    </a>
</li>



       <!-- 
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" 
       href="#" 
       id="kitchenDropdown"
       role="button"
       data-bs-toggle="dropdown" 
       aria-expanded="false">
        <span class="d-none d-lg-inline">
            Our<br><span class="nav-main-text">Kitchen</span>
        </span>
        <span class="d-inline d-lg-none">Our Kitchen</span>
        <span class="dropdown-arrow d-lg-none ms-2">&#9662;</span>
    </a>

    <ul class="dropdown-menu" aria-labelledby="kitchenDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('recipes') }}">Recipes</a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('chicken-blog') }}">Our Cooking Blog</a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('safehandling') }}">Safe Handling & Preparation</a>
        </li>
    </ul>
</li>


<!-- 
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-lg-inline">Our<br><span class="nav-main-text">Standards</span></span>
        <span class="d-inline d-lg-none">Our Standards</span>
        <span class="dropdown-arrow d-lg-none ms-2">&#9662;</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/our-standards/animal-welfare">Animal Welfare</a></li>
        <li><a class="dropdown-item" href="/our-standards/food-safety">Food Safety</a></li>
        <li><a class="dropdown-item" href="/our-standards/humane-practices">Humane Practices</a></li>
        <li><a class="dropdown-item" href="/our-standards/quality-standards">Quality Standards</a></li>
        <li><a class="dropdown-item" href="/our-standards/sustainability">Sustainability</a></li>
        <li><a class="dropdown-item" href="/our-standards/nutrition">Nutrition</a></li>
    </ul>
</li>



<!-- Shop (disabled for now)-->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="{{ route('shop.index') }}">
        <span class="nav-main-text">
            Our <span class="nav-main-text">Shop</span>
        </span>
        <span class="d-inline d-lg-none">Our Shop</span>
    </a>
</li>


<!-- Blog (disabled for now)-->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="/our-blog">
        <span class="nav-main-text">Our <span class="nav-main-text">Blog</span></span>
        <span class="d-inline d-lg-none">Our Blog</span>
    </a>
</li>


<!-- 
<li class="nav-item dropdown">
    <a class="nav-link d-flex align-items-center justify-content-between" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-lg-inline">Get<br><span class="nav-main-text">Facts</span></span>
        <span class="d-inline d-lg-none">Get Facts</span>
        <span class="dropdown-arrow d-lg-none ms-2">&#9662;</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/news/press-releases">Truths</a></li>
        <li><a class="dropdown-item" href="/news/awards">FAQs</a></li>
    </ul>
</li>

-->



     <!-- Contact -->
<li class="nav-item">
    <a class="nav-link d-flex align-items-center" href="{{ url('/#contact') }}">
        <span class="nav-main-text">Contact <span class="nav-main-text">Us</span></span>
        <span class="d-inline d-lg-none">Contact Us</span>
    </a>
</li>


    </ul>
</div>

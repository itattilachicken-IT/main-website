{{-- resources/views/safehandling.blade.php --}}
@extends('layouts.app')

@section('title', 'Safe Handling & Preparation of Chicken - Attila Chicken')

@section('content')
<div class="container my-5">
    <h1 class="fw-bold text-danger mb-4">Safe Handling & Preparation of Chicken - Attila Chicken</h1>

    <p class="lead">
        When it comes to chicken, safety is just as important as flavor. Proper handling and preparation 
        practices not only keep meals delicious, but they also protect your family and friends from 
        foodborne illnesses. Below are essential tips and guidelines to follow whenever you are 
        buying, storing, preparing, and cooking chicken.
    </p>

    <hr>

    <h2 class="fw-bold mt-4">1. Buying Fresh Chicken</h2>
    <ul>
        <li>Choose chicken that feels cold to the touch and is packaged securely.</li>
        <li>Check the “use by” or “sell by” dates before purchase.</li>
        <li>Keep raw chicken separate from other groceries, especially ready-to-eat items.</li>
    </ul>

    <h2 class="fw-bold mt-4">2. Storing Chicken Safely</h2>
    <ul>
        <li>Refrigerate chicken immediately after purchase at <strong>40°F (4°C) or below</strong>.</li>
        <li>If not cooking within 1–2 days, freeze chicken to extend freshness.</li>
        <li>Store raw chicken in sealed containers or plastic bags to avoid leaking juices.</li>
    </ul>

    <h2 class="fw-bold mt-4">3. Preparing Chicken</h2>
    <ul>
        <li>Wash hands with warm, soapy water before and after handling raw chicken.</li>
        <li>Never wash raw chicken — splashing water spreads bacteria.</li>
        <li>Use a separate cutting board and knife for raw chicken to avoid cross-contamination.</li>
        <li>Clean surfaces, utensils, and countertops thoroughly with hot, soapy water after contact with raw chicken.</li>
    </ul>

    <h2 class="fw-bold mt-4">4. Cooking Chicken Thoroughly</h2>
    <ul>
        <li>Cook chicken until it reaches an internal temperature of <strong>165°F (74°C)</strong>.</li>
        <li>Check doneness with a food thermometer in the thickest part of the meat.</li>
        <li>Ensure juices run clear, not pink.</li>
    </ul>

    <h2 class="fw-bold mt-4">5. Storing Leftovers</h2>
    <ul>
        <li>Refrigerate leftovers within <strong>2 hours</strong> of cooking.</li>
        <li>Store in shallow containers to cool evenly.</li>
        <li>Reheat leftovers to at least <strong>165°F (74°C)</strong> before eating.</li>
    </ul>

    <h2 class="fw-bold mt-4">6. Extra Safety Tips</h2>
    <ul>
        <li>Marinate chicken in the refrigerator, not on the counter.</li>
        <li>Discard leftover marinade that has touched raw chicken, or boil it before reuse.</li>
        <li>Be extra cautious when serving vulnerable groups (young children, elderly, or pregnant women).</li>
    </ul>

    <hr class="my-5">

    <h3 class="fw-bold text-danger">From Safety to Flavor</h3>
    <p>
        Once you master safe handling practices, you can focus on the fun part: flavor! 
        On our platform, we’ll also be sharing <a href="{{ route('recipes') }}">recipes</a> 
        and <a href="{{ route('chicken-blog') }}">cooking stories</a> to inspire your kitchen adventures. 
        Good food starts with safe preparation — and we’re here to guide you every step of the way.
    </p>
</div>
@endsection

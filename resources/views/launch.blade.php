@extends('layouts.app')

@section('title', 'Attila Chicken Brand Launch')

@section('content')
<div class="container my-2">
    <div class="text-center p-2 rounded" style="background: rgba(0,0,0,0.3);">
        <img src="{{ asset('images/logo1.jpg') }}" alt="Attila Chicken Logo" class="mb-2" style="max-width:200px;">
        <h1 class="display-7 fw-bold">Attila Chicken Brand Launch Event is Coming Soon!</h1>
        <p class="lead">We are launching our brand and investment network. Join us as a franchise partner or investor and be part of our growth journey!</p>

        {{-- Countdown Placeholder --}}
        <div class="countdown mb-2" id="countdown">Launch date will be announced soon!</div>

        {{-- Email Capture / Partnership Form --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('launch.subscribe') }}" method="POST" class="d-flex justify-content-center flex-column flex-sm-row gap-2 mb-2">
            @csrf
            <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter your email for partnership info" required>
            <button type="submit" class="btn btn-danger">Get Info</button>
        </form>

        {{-- Secondary Actions --}}
        <div class="mb-2">
            <a href="https://attilachicken.com" target="_blank" class="btn bt-dark btn-sm me-2">Visit Website</a>
            <a href="mailto:partnerships@attilachicken.com" class="btn btn-info btn-sm">Contact Us</a>
        </div>

        {{-- Social Share Buttons --}}
        <div class="social-btns mb-4">
            <a href="https://twitter.com/intent/tweet?text=Excited+for+Attila+Chicken+launch!" target="_blank" class="me-2"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="https://facebook.com/sharer/sharer.php?u=https://attilachicken.com" target="_blank" class="me-2"><i class="fab fa-facebook-f fa-lg"></i></a>
            <a href="https://linkedin.com/shareArticle?mini=true&url=https://attilachicken.com" target="_blank"><i class="fab fa-linkedin-in fa-lg"></i></a>
        </div>

        <p class="small">&copy; {{ date('Y') }} Attila Chicken. All rights reserved.</p>
    </div>
</div>
@endsection

@section('styles')
<style>
    .countdown {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .social-btns a {
        color: #fff;
        transition: color 0.3s;
    }
    .social-btns a:hover {
        color: #ffd700;
    }
</style>
@endsection

@section('scripts')
<script>
    // Countdown placeholder: replace with actual date later
    const countdownElement = document.getElementById('countdown');
    countdownElement.innerHTML = "Launch date will be announced soon!";
</script>
@endsection

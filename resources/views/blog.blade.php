@extends('layouts.app')

@section('title', 'Upcoming Blog - Attila Chicken')

@section('content')
<div class="container py-5 text-center">
    <h1 class="mb-4">📝 Our Blog is Coming Soon!</h1>

    <p class="lead mb-5">
        We are preparing to launch <strong>Our Blog</strong> — 
        your trusted source for insights into <strong>poultry farming, food safety, 
        sustainability, and healthy eating</strong>.
    </p>

    <div class="card shadow-lg border-0 mx-auto mb-5" style="max-width: 850px;">
        <div class="card-body py-5">
            <h2 class="card-title">What to Expect</h2>
            <p class="mb-4">
                Our blog will be more than just articles — it will be a space for learning, 
                sharing, and connecting. We’ll publish <strong>expert farming advice, cooking tips, 
                franchise updates, and sustainability practices</strong> to inspire both farmers 
                and food lovers.
            </p>
            <ul class="list-unstyled text-start mx-auto" style="max-width: 650px;">
                <li>✅ Poultry farming best practices</li>
                <li>✅ Safe handling & food preparation guides</li>
                <li>✅ Recipes straight from our kitchen</li>
                <li>✅ Behind-the-scenes from our farms</li>
                <li>✅ Updates on our franchise network</li>
            </ul>
        </div>
    </div>

    <h2 class="mb-4">Stay in the Loop</h2>
    <p class="mb-3">
        Be the first to read our posts when the blog launches.  
        Subscribe below and get notified when we go live!
    </p>

    <!-- Newsletter / Interest Form -->
    <form action="{{ route('upcoming.blog.subscribe') }}" method="POST" class="row g-3 justify-content-center mb-5">
        @csrf
        <div class="col-md-6">
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-lg w-100">Notify Me</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success shadow-sm d-inline-block">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-info d-inline-block shadow-sm" role="alert">
        📅 Launching Soon — Watch This Space!
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', $event->name ?? 'Attila Event')

@section('content')
<div class="container py-2" style="background: var(--light-gray); min-height: 100vh;">
    <div class="invite-card mx-auto animate-fadein">
        @yield('invite-content')
    </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>
    :root {
        --brand-red: #fe0000;
        --brand-yellow: #ffc600;
        --brand-black: #1a1a1a;
        --light-gray: #f8f8f8;
    }

    body {
        background-color: var(--light-gray) !important;
        font-family: 'Montserrat', sans-serif !important;
        color: var(--brand-black);
    }

    
    @keyframes fadein {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fadein {
        animation: fadein 0.7s ease-in-out;
    }

    .invite-card {
        background: #fff;
        width: 100%;
        max-width: 600px;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        overflow: hidden;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding-bottom: 1.2rem;
    }

    .invite-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 26px rgba(0, 0, 0, 0.18);
    }

    img.banner {
        width: 100%;
        max-height: 320px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .invite-content {
        padding: 28px;
    }

    h1, h2, h3 {
        color: var(--brand-red);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    p {
        color: var(--brand-black);
        line-height: 1.6;
        font-size: 1rem;
    }

    .btn {
        background-color: var(--brand-yellow);
        color: var(--brand-black);
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.1s ease-in-out, box-shadow 0.2s ease;
    }

    .btn:hover {
        background-color: #e6b800;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 198, 0, 0.3);
    }

    .btn:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(255, 198, 0, 0.4);
    }

    footer {
        margin-top: 40px;
        text-align: center;
        font-size: 0.9rem;
        color: #888;
    }

    @media (max-width: 576px) {
        .invite-card {
            margin: 1rem;
            border-radius: 12px;
        }

        img.banner {
            max-height: 240px;
        }
    }
</style>
@endpush

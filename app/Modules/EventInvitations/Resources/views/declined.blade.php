@extends('EventInvitations::layout')

@section('invite-content')
<style>
    
    .banner-wrapper {
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .event-banner {
        width: 100%;
        height: auto;
        border-radius: 10px;
        object-fit: cover;
        display: block;
    }

   
    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    
    .invite-content {
        max-width: 700px;
        margin: 0 auto;
        padding: 0.75rem;
        text-align: center;
    }

    .invite-content h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #b30000;
    }

    .invite-content p {
        font-size: 1rem;
        margin-bottom: 1rem;
        color: #333;
    }

    .invite-content strong {
        color: #000;
    }

    
    .btn {
        display: inline-block;
        background-color: #ffc600;
        color: #fff;
        padding: 0.6rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.25s ease;
        text-align: center;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #fe0000;
    }

   
    @media (min-width: 768px) {
        .invite-content h2 {
            font-size: 2rem;
        }
        .invite-content p {
            font-size: 1.2rem;
        }
    }
</style>


<div class="banner-wrapper fade-in">
    <img src="{{ asset('images/attilalaunch.webp') }}"
         alt="Event Banner"
         class="event-banner">
</div>


<div class="invite-content">
    <h2>RSVP Declined</h2>
    <p>Hello <strong>{{ $invite->guest_name }}</strong>,</p>
    <p>We appreciate your response regarding <strong>{{ $event->name }}</strong>.</p>
    <p>We’re sorry to hear that you won’t be able to join us at <strong>{{ $event->venue }}</strong>, but we completely understand and hope to see you at a future event.</p>

    <a href="{{ route('invite.show', $invite->token) }}" class="btn">View Invitation</a>
</div>
@endsection

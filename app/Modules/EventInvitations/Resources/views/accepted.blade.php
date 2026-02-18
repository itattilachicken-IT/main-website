@extends('EventInvitations::layout')

@section('invite-content')
<style>
:root {
    --brand-red: #C21807;
    --brand-yellow: #FFD84C;
    --brand-black: #222;
    --light-gray: #fdfdfd;
}

/* Banner styling */
.banner-wrapper {
    width: 100%;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 1rem;
    position: relative;
}

.event-banner {
    width: 100%;
    height: auto;
    border-radius: 10px;
    object-fit: cover;
    display: block;
}

/* Invite content */
.invite-content {
    max-width: 700px;
    margin: 0 auto;
    padding: 1.5rem;
    text-align: center;
    background: var(--light-gray);
    border-radius: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    position: relative;
    z-index: 2;
}

/* Dancing heading */
.invite-content h2 {
    font-family: 'Great Vibes', cursive;
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--brand-red);
    display: inline-block;
    animation: dance 1s ease-in-out infinite;
}

/* Sparkle effect for emoji */
.sparkle {
    display: inline-block;
    animation: sparkle 0.8s ease-in-out infinite;
}

@keyframes dance {
    0% { transform: translateY(0) rotate(0deg); }
    25% { transform: translateY(-5px) rotate(-2deg); }
    50% { transform: translateY(0) rotate(2deg); }
    75% { transform: translateY(5px) rotate(-2deg); }
    100% { transform: translateY(0) rotate(0deg); }
}

@keyframes sparkle {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.4); opacity: 0.7; }
}

/* Paragraph styling */
.invite-content p {
    font-size: 1rem;
    margin-bottom: 1rem;
    color: var(--brand-black);
    line-height: 1.6;
}

.invite-content strong {
    color: var(--brand-black);
}

/* Selected dates */
.selected-dates {
    background-color: #f8f9fa;
    color: var(--brand-black);
    padding: 0.8rem 1rem;
    border-radius: 10px;
    display: inline-block;
    margin-top: 1rem;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

.selected-dates div {
    display: inline;
}

.selected-dates .and-separator {
    color: var(--brand-red);
    font-weight: 700;
    margin: 0 0.5rem;
}

/* Button styling */
.btn {
    display: inline-block;
    background-color: var(--brand-yellow);
    color: var(--brand-black);
    padding: 0.6rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.25s ease;
    text-align: center;
    text-decoration: none;
    margin-top: 1rem;
}

.btn:hover {
    background-color: var(--brand-red);
    color: #fff;
}

/* Divider */
hr {
    border: none;
    border-top: 2px solid var(--brand-yellow);
    width: 80px;
    margin: 2rem auto 1rem auto;
}

/* Fireworks animation */
.fireworks {
    position: absolute;
    top: -100px;
    left: 50%;
    transform: translateX(-50%);
    width: 250px;
    height: 250px;
    background: url('{{ asset('images/fireworks.gif') }}') no-repeat center/contain;
    z-index: 1;
    pointer-events: none;
    animation: fadeIn 2s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@media (min-width: 768px) {
    .invite-content h2 {
        font-size: 3rem;
    }
    .invite-content p {
        font-size: 1.15rem;
    }
}
</style>

<!-- Fireworks -->
<div class="fireworks"></div>

<!-- Banner -->
<div class="banner-wrapper fade-in">
    <img src="{{ asset('images/attilalaunch.webp') }}" alt="Event Banner" class="event-banner">
</div>

<!-- Invite content -->
<div class="invite-content fade-in">

    <h2>Hooray! Your RSVP is Confirmed <span class="sparkle">🎉</span></h2>

    <p>Thank you, <strong>{{ $invite->guest_name }}</strong>!  
       Your RSVP for <strong>{{ $event->name }}</strong> has been successfully recorded as  
       <strong>{{ ucfirst($invite->status) }}</strong>.
    </p>

    @if(!empty($event_dates))
        <p>We’re thrilled that you’ll be joining us for:</p>
        <div class="selected-dates">
            @foreach ($event_dates as $i => $date)
                @if (Str::contains($date, '28'))
                    <div>🥂 Attila Chicken Menu Tasting & Golf Tournament on <strong>Friday, 28th Nov 2025</strong></div>
                @elseif (Str::contains($date, '29'))
                    <div>🎊 Investors' Attila Chicken Launch Event on <strong>Saturday 29th Nov 2025</strong></div>
                @else
                    <div>{{ $date }}</div>
                @endif

                @if (!$loop->last)
                    <span class="and-separator">&amp;</span>
                @endif
            @endforeach
        </div>
    @else
        <p>We can’t wait to see you at <strong>{{ $event->venue }}</strong> on  
           <strong>{{ $event->start_date->format('j M Y') }}</strong>!
        </p>
    @endif

    <a href="{{ route('invite.show', $invite->token) }}" class="btn">View Invitation Again</a>

    <hr>

    <p style="font-size: 0.95rem; color: #666;">
        Warm regards,<br>
        <strong>Attila</strong>
    </p>
</div>
@endsection

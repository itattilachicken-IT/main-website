<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reminder - {{ $invite->guest_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        @page { margin: 0; }
        body { margin:0; padding:0; font-family:'Montserrat', sans-serif; background:#f0f0f0; }

        .card {
            width: 100%;
            padding: 15px 10px;
            background-color: #fe0000; /* brand red */
            border-radius: 25px;
            text-align: center;
            color: #fff;
            box-sizing: border-box;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .banner { width: 100%; max-width: 560px; border-radius: 16px; margin: 0 auto 10px; display: block; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

        .greeting { font-size: 28px; font-weight: 700; margin: 10px 0 10px; }
        .message { font-size: 20px; margin: 5px 0 15px; line-height: 1.6; color: #fff; }

        .countdown-badge { display: inline-block; background-color: #ffc600; color: #000; font-weight: 700; font-size: 20px; padding: 10px 20px; border-radius: 30px; margin: 15px 0; box-shadow: 0 4px 8px rgba(0,0,0,0.25); }

        .rsvp-button { display: inline-block; background: #ffc600; color: #000; font-weight: 700; padding: 12px 28px; border-radius: 30px; margin: 10px 0; font-size: 16px; text-decoration: none; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

        .footer { font-size: 14px; margin-top: 15px; color: #fff; font-weight: 500; }
        .deadline-badge {
    display: inline-block;
    background-color: #ffc600; /* bright yellow */
    color: #000;
    font-weight: 700;
    font-size: 20px;
    padding: 10px 20px;
    border-radius: 30px;
    margin: 10px 0;
    box-shadow: 0 4px 8px rgba(0,0,0,0.25);
}

    </style>
</head>
<body>
    @php
        

        // Embed image as base64 for PDF rendering
        $path = public_path('images/attilalaunchreminder.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp

    <div class="card">
        <a href="{{ $invite->rsvp_result_link }}">
            <img src="{{ $base64 }}" class="banner" alt="Event Banner">
        </a>

        <div class="greeting">Hi {{ $invite->guest_name }},</div>

<div class="message">
    We noticed you haven’t reserved your spot yet for the <strong>{{ $eventName }}</strong> event.
    Don’t miss out — secure your attendance now!
</div>

 @php
use Carbon\Carbon;

// RSVP deadline
$rsvpDeadline = Carbon::createFromFormat('d-m-Y', '26-11-2025');
$deadlineFormatted = $rsvpDeadline->format('l, d F Y'); // e.g., Wednesday, 26 November 2025
@endphp

<!-- RSVP Button -->
<div><a href="{{ $invite->rsvp_result_link }}" class="rsvp-button" target="_blank">
    Reserve Your Spot Here by {{ $deadlineFormatted }}
</a></div>

        <div class="footer">
            We can’t wait to celebrate with you! 
        </div>
    </div>
</body>
</html>

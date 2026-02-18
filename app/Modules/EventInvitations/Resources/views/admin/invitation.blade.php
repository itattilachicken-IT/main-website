<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RSVP - {{ $invite->guest_name }}</title>
    <style>
        @page { margin: 0; }
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            text-align: center;
        }
        .rsvp-card {
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            background: #fafafa;
        }
        .banner {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .event-name {
            font-size: 1.8rem;
            color: #C21807;
            font-weight: 700;
        }
        .guest-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-top: 10px;
        }
        .rsvp-link {
            font-size: 0.9rem;
            color: #007bff;
            word-break: break-all;
            margin: 15px 0;
        }
        .footer {
            font-size: 0.9rem;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="rsvp-card">
        <img src="{{ public_path('images/rsvp-banner.jpg') }}" alt="RSVP Banner" class="banner">

        <h2 class="event-name">{{ $invite->event_name }}</h2>
        <h3 class="guest-name">{{ $invite->guest_name }}</h3>

        <p class="rsvp-link">{{ $invite->invite_link }}</p>

        <p class="footer">We look forward to seeing you 🎉</p>
    </div>
</body>
</html>

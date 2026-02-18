<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RSVP - {{ $invite->guest_name }}</title>
    <style>
        @page { margin: 0; }
        body { margin:0; padding:0; font-family: 'Montserrat', sans-serif; background:#f8f8f8; }
        .card {
            width:100%;
            height:100%;
            padding:30px;
            background:#fe0000;
            border-radius:25px;
            text-align:center;
            color:#fff;
            box-sizing:border-box;
            box-shadow: 0 12px 28px rgba(0,0,0,0.2);
        }
        .banner { 
            width:100%; 
            max-width:560px; 
            border-radius:14px; 
            margin:0 auto 20px; 
            display:block; 
            object-fit: cover;
        }
        .guest-name { 
            font-size:24px; 
            font-weight:700; 
            margin:16px 0 12px; 
            color:#fff;
        }
        .status { 
            display:inline-block; 
            background:#ffc600; 
            color:#000; 
            font-weight:700; 
            padding:10px 20px; 
            border-radius:25px; 
            margin:16px 0; 
            font-size:16px; 
            text-decoration:none; 
        }
        .events {
            background:#fff;
            border-left:5px solid #fe0000;
            border-radius:12px;
            padding:16px;
            margin:16px auto;
            width:90%;
            text-align:left;
            font-size:14px;
            font-weight:500;
            color:#000;
            box-sizing: border-box;
        }
        .events h4 { 
            margin-bottom:10px; 
            color:#fe0000; 
            font-weight:700; 
            text-transform:uppercase; 
            font-size:14px; 
        }
        .events div {
            margin-bottom:10px;
        }
        .events strong { 
            font-weight:700; 
            color:#222; 
        }
        .footer { 
            font-size:14px; 
            margin-top:16px; 
            color:#fff; 
            font-weight:500; 
        }
    </style>
</head>
<body>
    <div class="card">
        @php
            $path = public_path('images/attilaacceptance.jpg');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        
        <img src="{{ $base64 }}" class="banner" alt="Event Banner">
        
        <h2 class="guest-name">Dear {{ $invite->guest_name }},</h2>

        @if(!empty($event_dates))
            <p style="font-weight:600; color:#fff;">We’re thrilled that you’ll be joining us for:</p>
            <div class="events">
                @foreach ($event_dates as $date)
                    @if (Str::contains($date, '28'))
                        <div><h4>Attila Chicken Menu Tasting & Golf Tournament on <strong>Friday, 28th Nov 2025</strong> FROM 6:30 A.M. TO 6:00 P.M.</h4></div>
                    @elseif (Str::contains($date, '29'))
                        <div><h4>Investors' Attila Chicken Launch Event on <strong>Saturday, 29th Nov 2025</strong> FROM 12:00 NOON TO 5:00 P.M.</h4></div>
                    @else
                        <div>{{ $date }}</div>
                    @endif
                @endforeach
            </div>
        @else
            <p style="color:#fff;">We can’t wait to see you at <strong>{{ $event->venue }}</strong> on  
               <strong>{{ $event->start_date->format('j M Y') }}</strong>!
            </p>
        @endif

        <div class="status">
            Reserved Spots: {{ $attendanceType === 'group' ? $attendanceNumber : 1 }}
        </div>

        <p class="footer">We can't wait to celebrate with you!</p>
    </div>
</body>
</html>

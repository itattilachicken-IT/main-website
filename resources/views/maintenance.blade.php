<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Under Maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f0f0;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            color: #ff9900;
        }
        p {
            font-size: 1.2rem;
            margin: 1rem 0;
        }
        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>We'll be back soon!</h1>
    <p>Our website is currently undergoing maintenance.<br>
       Thank you for your patience.</p>
    <div class="footer">
        &copy; {{ date('Y') }} Attila Chicken
    </div>
</body>
</html>

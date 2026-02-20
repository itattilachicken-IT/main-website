<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page In Progress</title>

    @vite('resources/css/app2.css')

    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            background: #f6f7f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .construction-wrapper {
            text-align: center;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            max-width: 500px;
            width: 90%;
        }

        .construction-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .construction-wrapper h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #222;
            letter-spacing: 0.5px;
        }

        .construction-wrapper p {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .progress-bar {
            height: 6px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 60%;
            background: #FE0000;
            animation: loading 2s infinite ease-in-out alternate;
        }

        @keyframes loading {
            from { width: 40%; }
            to { width: 80%; }
        }

        .back-btn {
            margin-top: 25px;
            display: inline-block;
            padding: 8px 18px;
            font-size: 13px;
            background: #FE0000;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .back-btn:hover {
            opacity: 0.85;
        }

        @media(max-width:600px){
            .construction-wrapper {
                padding: 35px 20px;
            }

            .construction-wrapper h1 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="construction-wrapper">
        <div class="construction-icon">🚧</div>
        <h1>Building Page In Progress</h1>
        <p>This section is currently under development. Please check back soon.</p>

        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>

        <a href="{{ url()->previous() }}" class="back-btn">
            ← Go Back
        </a>
    </div>

</body>
</html>
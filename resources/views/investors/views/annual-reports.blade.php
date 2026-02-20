<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Annual Reports — Investor Relations</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content" id="mainContent">
    @include('partials.topbar')

        {{-- Annual Reports Content --}}
        <section class="section">
            <div class="container">

                <h1 class="page-title">Annual Reports</h1>

                <div class="reports-grid">

                    @foreach ($annualreports as $report)
                        <div class="presentation-item">
                            <img class="presentation-image"
                                 src="{{ $report['image'] }}"
                                 alt="{{ $report['title'] }}">

                            <div class="presentation-title">
                                {{ $report['title'] }}
                            </div>

                            <div class="presentation-date">
                                {{ $report['date'] }}
                            </div>

                            <a class="download-btn"
                               href="{{ $report['download_link'] }}">
                               DOWNLOAD REPORT
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

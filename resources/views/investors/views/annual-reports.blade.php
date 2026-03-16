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

      

             <div class="reports-grid">

                    @forelse ($annualreports as $report)
                        <div class="presentation-item">
                            <img class="presentation-image"
                                src="{{ $report['cover_image'] }}"
                                alt="{{ $report['title'] }}">

                            <div class="presentation-title">
                                {{ $report['title'] }}
                            </div>

                            <div class="presentation-date">
                                {{ $report['date'] }}
                            </div>

                            <a class="download-btn"
                            href="{{ $report['download_link'] }}"
                            download>
                            DOWNLOAD REPORT
                            </a>
                        </div>
                    @empty
                        <p>No annual reports available.</p>
                    @endforelse

                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

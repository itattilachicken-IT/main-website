<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $release['title'] ?? 'Press Release' }} — Investor Relations</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar / Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content" id="mainContent">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

                <a class="back-link" href="{{ url('/press-releases') }}">
                    ← Back to Press Releases
                </a>

                <h1 class="page-title">
                    {{ $release['title'] ?? 'Press Release' }}
                </h1>

                <div class="meta">
                    {{ $release['date'] ?? '' }}
                </div>

                <div class="release-content">
                    {!! nl2br(e($release['content'] ?? '')) !!}
                </div>

                <a class="back-link" href="{{ url('/press-releases') }}">
                    ← Back to Press Releases
                </a>

            </div>
        </section>

    </main>

</div>

</body>
</html>

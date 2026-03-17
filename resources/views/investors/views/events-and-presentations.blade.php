<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
    <title>Events and Presentations — Investor Relations</title>
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar / Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content" id="mainContent">
        @include('partials.topbar')
        

        {{-- Page Content --}}
        <section class="section">
            <div class="container">

                {{-- Notice --}}
                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        View our latest events and presentations to stay informed about our recent activities, strategic initiatives, and industry insights.
                       
                    </p>
                </div>

                <div class="two-column">

                    {{-- Events --}}
                    <div>
                        <h2>Events</h2>

                        @forelse ($events as $event)
                            <div class="event-item">
                                <div class="event-title">{{ $event['title'] }}</div>
                                <div class="event-date">{{ $event['date'] }}</div>
                                <div class="event-time">Time {{ $event['time'] }}</div>
                                <div class="event-description">{{ $event['description'] }}</div>
                                
                            </div>
                        @empty
                            <p>No events available at the moment.</p>
                        @endforelse
                    </div>

                    {{-- Presentations --}}
                    <div>
                        <h2>Presentations</h2>

                        @forelse ($presentations as $presentation)
                            <div class="presentation-item">
                                <img class="presentation-image"
                                    src="{{ asset('contracts/presentations/'.$presentation['image']) }}"
                                    alt="{{ $presentation['title'] }}">

                                <div class="presentation-title">{{ $presentation['title'] }}</div>
                                <div class="presentation-date">{{ $presentation['date'] }}</div>

                                <a class="download-btn"
                                    href="{{ asset('contracts/presentations/'.$presentation['pdf_file']) }}"
                                    download>
                                    DOWNLOAD PRESENTATION
                                </a>
                            </div>
                        @empty
                            <p>No presentations available at the moment.</p>
                        @endforelse
                    </div>

                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

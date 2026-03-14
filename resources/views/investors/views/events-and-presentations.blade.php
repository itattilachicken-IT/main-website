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

                

                <div class="two-column">

                    {{-- Events --}}
                    <div>
                        <h2>Events</h2>

                        @forelse ($events as $event)
                            <div class="event-item">
                                <div class="event-title">{{ $event['title'] }}</div>
                                <div class="event-date">{{ $event['date'] }}</div>
                                <div class="event-time">{{ $event['time'] }}</div>
                                <div class="event-description">{{ $event['description'] }}</div>
                                @if($event['link'])
                                    <a class="event-link" href="{{ $event['link'] }}" target="_blank">
                                        {{ $event['link_text'] }}
                                    </a>
                                @endif
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
                                    src="{{ asset('/'.$presentation['image']) }}"
                                    alt="{{ $presentation['title'] }}">

                                <div class="presentation-title">{{ $presentation['title'] }}</div>
                                <div class="presentation-date">{{ $presentation['date'] }}</div>

                                <a class="download-btn" 
                                    href="{{ asset('../'.$presentation['download_link']) }}" 
                                    download="{{ $presentation['download_link'] }}" 
                                    target="_blank">
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

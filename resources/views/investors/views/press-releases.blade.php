<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Press Releases — Investor Relations</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout" id="dashboardLayout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

                <h2>Press Releases</h2>

                {{-- Disclaimer --}}
                <div class="card" style="margin-bottom:20px;">
                    <p class="lead">
                        The news releases on, and linked from, this page are effective only as of their respective dates and Attila Chicken disclaims any responsibility to update them.
                    </p>
                </div>

                {{-- Filters --}}
                <div class="card" style="margin-bottom:30px;">
                    <div class="filters">

                        <form method="GET" action="{{ url('/investors/views/press-releases') }}" class="filter-group">

                            <select name="year">
                                <option value="">All Years</option>
                                <option value="2026" {{ request('year') === '2026' ? 'selected' : '' }}>2026</option>
                                <option value="2025" {{ request('year') === '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2024" {{ request('year') === '2024' ? 'selected' : '' }}>2024</option>
                            </select>

                            <input type="text" name="search" placeholder="Search"
                                   value="{{ request('search') }}" class="search-input">

                            <button class="btn-primary" type="submit">GO</button>

                            <a class="advanced-link" href="#">Advanced Search</a>

                        </form>

                    </div>
                </div>

                {{-- Releases --}}
                <div class="releases">

                    @foreach ($releases as $release)
                        <div class="card release-item">
                            <div class="release-date">{{ $release['date'] }}</div>

                            <h3>
                                <a href="{{ url('/investors/views/press-releases/' . $release['slug']) }}">
                                    {{ $release['title'] }}
                                </a>
                            </h3>

                            <p class="lead">
                                {{ substr($release['content'], 0, 200) }}...
                            </p>
                        </div>
                    @endforeach

                </div>

                {{-- Pagination Controls --}}
                <div class="card pagination-controls">

                    <div class="per-page">
                        Show
                        <select onchange="location.href='{{ url('/investors/views/press-releases?per_page=') }}' + this.value">
                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25</option>
                        </select>
                        per page
                    </div>

                    <div class="pagination">
                        <a href="#">&lt;</a>
                        <span class="active">1</span>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">7</a>
                        <a href="#">8</a>
                        <a href="#">9</a>
                        <a href="#">...</a>
                        <a href="#">146</a>
                        <a href="#">&gt;</a>
                    </div>

                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

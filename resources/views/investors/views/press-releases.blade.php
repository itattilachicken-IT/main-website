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
        <option value="2026" {{ request('year') == '2026' ? 'selected' : '' }}>2026</option>
        <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
    </select>

    <input type="text"
           name="search"
           placeholder="Search"
           value="{{ request('search') }}"
           class="search-input">

    <button class="btn-primary" type="submit">GO</button>

</form>

                    </div>
                </div>

                {{-- Releases --}}
              <div class="releases">

                    @forelse ($releases as $release)

                        <div class="card release-item">

                            <div class="release-date">
                                {{ \Carbon\Carbon::parse($release->date)->format('d M Y') }}
                            </div>

                            {{-- Clickable Title --}}
                            <h3 class="release-title"
                                onclick="toggleRelease('release-{{ $release->id }}')"
                                style="cursor:pointer;">

                                {{ $release->title }}
                                <span class="toggle-icon" id="icon-release-{{ $release->id }}">Read ▼</span>

                            </h3>

                            {{-- Short Preview --}}
                            <p class="lead">
                                {{ \Illuminate\Support\Str::limit($release->content, 200) }}
                            </p>

                            {{-- Hidden Full Content --}}
                            <div id="release-{{ $release->id }}"
                                class="release-full-content"
                                style="display:none; margin-top:15px;">

                                <hr>

                                <p>
                                    {!! nl2br(e($release->content)) !!}
                                </p>

                            </div>

                        </div>

                    @empty
                        <p>No press releases found.</p>
                    @endforelse

                    </div>

                {{-- Pagination Controls --}}
                <div class="card pagination-controls">

    <div class="per-page">
        Show

        <select onchange="window.location.href=this.value">

            <option value="{{ request()->fullUrlWithQuery(['per_page' => 5]) }}"
                {{ request('per_page', 5) == 5 ? 'selected' : '' }}>
                5
            </option>

            <option value="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}"
                {{ request('per_page') == 10 ? 'selected' : '' }}>
                10
            </option>

            <option value="{{ request()->fullUrlWithQuery(['per_page' => 25]) }}"
                {{ request('per_page') == 25 ? 'selected' : '' }}>
                25
            </option>

        </select>

        per page
    </div>

    <div class="pagination">
        {{ $releases->links() }}
    </div>

</div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

<script>
function toggleRelease(id)
{
    const content = document.getElementById(id);
    const icon = document.getElementById("icon-" + id);

    if (content.style.display === "none" || content.style.display === "")
    {
        content.style.display = "block";
        icon.innerHTML = "Close ▲";
    }
    else
    {
        content.style.display = "none";
        icon.innerHTML = "Read ▼";
    }
}
</script>


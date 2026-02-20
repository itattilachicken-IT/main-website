<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Board of Directors — Investor Relations</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">

        {{-- Topbar --}}
        @include('partials.topbar')

        <section class="section">
            <div class="container">

               
                <p class="page-subtitle">
                    Meet the leadership and governance team guiding Attila.
                </p>

                <div class="cards board-grid">

                    {{-- Director Card --}}
                    <div class="card director-card">

                        <h3 class="director-name">Ann Kanyori</h3>

                        <p class="director-title">
                            Director of Board and CEO
                        </p>

                        <p class="director-committee">
                            Committee: Attila Poultry Farm
                        </p>

                        <p class="director-bio">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type and scrambled it to make a type 
                            specimen book. It has survived not only five centuries, but also the leap into 
                            electronic typesetting, remaining essentially unchanged. It was popularised in 
                            the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                            and more recently with desktop publishing software like Aldus PageMaker including 
                            versions of Lorem Ipsum.
                        </p>

                    </div>

                    {{-- Add more directors easily --}}
                    <div class="card director-card">

                        <h3 class="director-name">Example 2</h3>

                        <p class="director-title">
                            Chairman of the Board and Co-President
                        </p>

                        <p class="director-committee">
                            Committee: Attila Poultry Farm
                        </p>

                        <p class="director-bio">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type and scrambled it to make a type 
                            specimen book. It has survived not only five centuries, but also the leap into 
                            electronic typesetting, remaining essentially unchanged. It was popularised in 
                            the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                            and more recently with desktop publishing software like Aldus PageMaker including 
                            versions of Lorem Ipsum.
                        </p>

                    </div>
                    {{-- 
                    <div class="card director-card">
                        <h3 class="director-name">Director Name</h3>
                        <p class="director-title">Role</p>
                        <p class="director-committee">Committee</p>
                        <p class="director-bio">Biography...</p>
                    </div>
                    --}}

                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

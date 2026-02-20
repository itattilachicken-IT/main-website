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

                <h1 class="page-title">Board of Directors</h1>
                <p class="page-subtitle">
                    Meet the leadership and governance team guiding Attila Chicken.
                </p>

                <div class="cards board-grid">

                    {{-- Director Card --}}
                    <div class="card director-card">

                        <h3 class="director-name">Kemper Isely</h3>

                        <p class="director-title">
                            Chairman of the Board and Co-President
                        </p>

                        <p class="director-committee">
                            Committee: Compensation Committee
                        </p>

                        <p class="director-bio">
                            Kemper Isely has been a director and our Co-President since 1998. 
                            He joined the Company as an employee in 1977 and during his tenure 
                            has functioned as Store Manager, Warehouse Manager, Director of 
                            Marketing, Director of Purchasing, Director of Operations and 
                            Director of Finance.
                        </p>

                    </div>

                    {{-- Add more directors easily --}}
                    <div class="card director-card">

                        <h3 class="director-name">Kemper Isely</h3>

                        <p class="director-title">
                            Chairman of the Board and Co-President
                        </p>

                        <p class="director-committee">
                            Committee: Compensation Committee
                        </p>

                        <p class="director-bio">
                            Kemper Isely has been a director and our Co-President since 1998. 
                            He joined the Company as an employee in 1977 and during his tenure 
                            has functioned as Store Manager, Warehouse Manager, Director of 
                            Marketing, Director of Purchasing, Director of Operations and 
                            Director of Finance.
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

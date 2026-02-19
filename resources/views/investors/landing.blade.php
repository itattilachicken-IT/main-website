<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Relations — Attila Chicken</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
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

            <!-- Dashboard Overview Section -->
            <div class="dashboard-overview">
                <div class="overview-card">
                    <h3>Total Invested</h3>
                    <p class="amount">KES 1,500,000</p>
                </div>
                <div class="overview-card">
                    <h3>Portfolio Value</h3>
                    <p class="amount">KES 2,700,000</p>
                </div>
                <div class="overview-card">
                    <h3>ROI to Date</h3>
                    <p class="amount highlight">18.5%</p>
                </div>
                <div class="overview-card">
                    <h3>Cash Distributed</h3>
                    <p class="amount">KES 750,000</p>
                </div>
               
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-container">
                    <h3>Investment Growth</h3>
                    <canvas id="investmentGrowthChart"></canvas>
                </div>

                <div class="chart-container">
                    <h3>Yield Breakdown</h3>
                    <canvas id="yieldBreakdownChart"></canvas>
                </div>

                
            </div>
            <div class="cashflow-container">
                    <h3>Cashflow Overview</h3>
                    <canvas id="cashflowOverviewChart"></canvas>
            </div>

        </div>
    </section>

    

</main>


</div>

</body>
</html>

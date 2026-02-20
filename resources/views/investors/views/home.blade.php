<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Relations — Attila Chicken</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

                @php
                    $totalInvestment = 1343500;
                    $payoutAmount = 1050000;
                    $totalPayouts = 6;
                    $receivedPayouts = 1;

                    $totalReturn = $payoutAmount * $totalPayouts;
                    $receivedAmount = $payoutAmount * $receivedPayouts;
                    $remainingAmount = $totalReturn - $receivedAmount;

                    $progressPercent = ($receivedPayouts / $totalPayouts) * 100;
                    $roiToDate = ($receivedAmount / $totalInvestment) * 100;
                @endphp

                <!-- Overview Cards -->
                <div class="dashboard-overview">

                    <div class="overview-card">
                        <h3>Total Investment</h3>
                        <p class="amount">KES {{ number_format($totalInvestment) }}</p>
                    </div>

                    <div class="overview-card">
                        <h3>Total Expected Return</h3>
                        <p class="amount">KES {{ number_format($totalReturn) }}</p>
                    </div>

                    <div class="overview-card">
                        <h3>Amount Received</h3>
                        <p class="amount">KES {{ number_format($receivedAmount) }}</p>
                    </div>

                    <div class="overview-card">
                        <h3>Remaining Balance</h3>
                        <p class="amount">KES {{ number_format($remainingAmount) }}</p>
                    </div>

                    <div class="overview-card">
                        <h3>Payment Progress</h3>
                        <p class="amount highlight">{{ number_format($progressPercent, 2) }}%</p>
                    </div>

                    <div class="overview-card">
                        <h3>ROI To Date</h3>
                        <p class="amount highlight">{{ number_format($roiToDate, 2) }}%</p>
                    </div>

                </div>

                <!-- Charts Section -->
                <div class="charts-section">

                    <div class="chart-container">
                        <h3>Investment Progression (6 Payout Cycle)</h3>
                        <canvas id="investmentGrowthChart"></canvas>
                    </div>

                    <div class="chart-container">
                        <h3>Return Breakdown</h3>
                        <canvas id="yieldBreakdownChart"></canvas>
                    </div>

                </div>
                <br>

                <div class="cashflow-container">
                    <h3>Cashflow Timeline</h3>
                    <canvas id="cashflowOverviewChart"></canvas>
                </div>

            </div>
        </section>

    </main>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT SECTION -->
<!-- ============================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const totalInvestment = {{ $totalInvestment }};
    const payoutAmount = {{ $payoutAmount }};
    const totalPayouts = {{ $totalPayouts }};
    const receivedPayouts = {{ $receivedPayouts }};

    const totalReturn = payoutAmount * totalPayouts;
    const receivedAmount = payoutAmount * receivedPayouts;
    const remainingAmount = totalReturn - receivedAmount;

  /* ===============================
   1. INVESTMENT PROGRESSION
================================ */

const ctxLine = document.getElementById('investmentGrowthChart').getContext('2d');

const gradient = ctxLine.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(132, 255, 0, 0.4)');
gradient.addColorStop(1, 'rgba(132, 255, 0, 0.02)');

new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: [
            'Start',
            'Payout 1',
            'Payout 2',
            'Payout 3',
            'Payout 4',
            'Payout 5',
            'Payout 6'
        ],
        datasets: [{
            label: 'Cumulative Return (KES)',
            data: [
                0,
                payoutAmount,
                payoutAmount * 2,
                payoutAmount * 3,
                payoutAmount * 4,
                payoutAmount * 5,
                payoutAmount * 6
            ],
            borderColor: '#84ff00',
            backgroundColor: gradient,
            pointBackgroundColor: '#84ff00',
            pointBorderColor: '#fff',
            pointRadius: 5,
            borderWidth: 3,
            tension: 0.45,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: {
                top: 20,
                right: 20,
                bottom: 30,   // 👈 adds space for rotated labels
                left: 10
            }
        },
        plugins: {
            legend: {
                labels: { color: '#ccc' }
            },
            tooltip: {
                backgroundColor: '#111',
                titleColor: '#84ff00',
                bodyColor: '#fff'
            }
        },
        scales: {
            x: {
                ticks: {
                    color: '#aaa',
                    padding: 10   // 👈 extra spacing from axis
                },
                grid: { color: 'rgba(255,255,255,0.05)' }
            },
            y: {
                ticks: {
                    color: '#aaa',
                    padding: 10
                },
                grid: { color: 'rgba(255,255,255,0.05)' }
            }
        }
    }

});
/* ===============================
   2. RETURN BREAKDOWN
================================ */

new Chart(document.getElementById('yieldBreakdownChart'), {
    type: 'doughnut',
    data: {
        labels: ['Received', 'Remaining'],
        datasets: [{
            data: [receivedAmount, remainingAmount],
            backgroundColor: ['#22c55e', '#ef4444'],
            borderWidth: 0,
            cutout: '65%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#555',
                    padding: 20
                }
            }
        }
    }
});
    /* ===============================
       3. CASHFLOW TIMELINE
    =============================== */

    new Chart(document.getElementById('cashflowOverviewChart'), {
        type: 'bar',
        data: {
            labels: [
                'Apr 2026',
                'Jun 2026',
                'Aug 2026',
                'Oct 2026',
                'Dec 2026',
                'Feb 2027'
            ],
            datasets: [{
                label: 'Scheduled Payout (KES)',
                data: [
                    payoutAmount,
                    payoutAmount,
                    payoutAmount,
                    payoutAmount,
                    payoutAmount,
                    payoutAmount
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            }
        }
    });

});
</script>

</body>
</html>
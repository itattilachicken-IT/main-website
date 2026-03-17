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
                {{-- Notice --}}
                @php
                    $hour = now()->hour;
                    $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
                @endphp

                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        {{ $greeting }} {{ session('investor_name', 'Investor') }}, 
                        welcome back to your dashboard.
                    </p>
                </div>

{{-- CONTRACT LIFESPAN BAR --}}
@php
    use Carbon\Carbon;

    // Get logged-in investor's code from session
    $investorCode = session('investor_code');

    // Get only payments for this investor
    $payments = DB::table('investor_payments')
        ->where('investor_code', $investorCode)
        ->orderBy('payment_date')
        ->get();

    if ($payments->count() > 0) {

        // Round start and end dates to whole day
        $startDate = Carbon::parse($payments->min('placement_date'))->startOfDay();
        $endDate = Carbon::parse($payments->max('payment_date'))->startOfDay();

        // Today's date at start of day
        $today = Carbon::today();

        // Total duration in whole days
        $totalDays = max(1, $startDate->diffInDays($endDate));

        // Days passed since start
        $daysPassed = $startDate->diffInDays($today, false);
        $daysPassed = max(0, min($daysPassed, $totalDays));

        // Days left (whole days)
        $daysLeft = max(0, $today->diffInDays($endDate, false));

        // Progress percentage
        $percent = ($daysPassed / $totalDays) * 100;
    }
@endphp

@if(isset($percent))
<div class="card lifespan-card">
    
    <div class="lifespan-header">
        <strong>Contract Lifespan</strong>
        <span>{{ $daysLeft }} days remaining</span>
    </div>

    <div class="lifespan-bar">
        <div 
            class="lifespan-progress {{ $daysLeft < 30 ? 'danger' : '' }}"
            style="width: {{ $percent }}%">
        </div>
    </div>

    <div class="lifespan-dates">
        <span>{{ $startDate->format('j M Y') }}</span>
        <span>{{ $endDate->format('j M Y') }}</span>
    </div>

</div>
@endif

            

                @php
                    $totalInvestment = $investor->total_investment ?? 0;

                    $totalPayouts = $payments->count();
                    $payoutAmount = $payments->first()->amount ?? 0;

                    $totalReturn = $payments->sum('amount');

                    $receivedAmount = 0;
                    $remainingAmount = 0;
                    $receivedPayouts = 0;

                    $today = now();

                    foreach ($payments as $p) {
                        if ($p->payment_date && $p->payment_date <= $today) {
                            $receivedAmount += $p->amount;
                            $receivedPayouts++;
                        } else {
                            $remainingAmount += $p->amount;
                        }
                    }

                    $progressPercent = $totalPayouts > 0
                        ? ($receivedPayouts / $totalPayouts) * 100
                        : 0;

                    $roiToDate = $totalInvestment > 0
                        ? ($receivedAmount / $totalInvestment) * 100
                        : 0;
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

            

            </div>
        </section>

    </main>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT SECTION -->
<!-- ============================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const payments = @json($payments); // Payments passed from controller
    const totalInvestment = {{ $totalInvestment }};
    const today = new Date().getTime();

    // ===============================
    // 1. Prepare Data
    // ===============================
    let receivedAmount = 0;
    let remainingAmount = 0;
    let cumulative = 0;
    let labels = ['Start'];
    let cumulativeData = [0];
    let receivedCount = 0;

    payments.forEach((p, index) => {
        const payDate = new Date(p.payment_date).getTime();
        const amount = parseFloat(p.amount);

        if (payDate <= today) {
            cumulative += amount;
            receivedAmount += amount;
            receivedCount++;
            labels.push(`Payout ${index + 1}`);
            cumulativeData.push(cumulative);
        } else {
            remainingAmount += amount;
        }
    });

    const totalReturn = cumulative + remainingAmount; // expected total return
    const progressPercent = payments.length > 0 ? (receivedCount / payments.length) * 100 : 0;
    const roiToDate = totalInvestment > 0 ? (receivedAmount / totalInvestment) * 100 : 0;

    // ===============================
    // 2. INVESTMENT PROGRESSION (Line Chart)
    // ===============================
    const ctxLine = document.getElementById('investmentGrowthChart').getContext('2d');
    const gradient = ctxLine.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(132, 255, 0, 0.4)');
    gradient.addColorStop(1, 'rgba(132, 255, 0, 0.02)');

    new Chart(ctxLine, {
        type: 'line',
        data: { labels: labels, datasets: [{
            label: 'Cumulative Return (KES)',
            data: cumulativeData,
            borderColor: '#84ff00',
            backgroundColor: gradient,
            pointBackgroundColor: '#84ff00',
            pointBorderColor: '#fff',
            pointRadius: 5,
            borderWidth: 3,
            tension: 0.45,
            fill: true
        }]},
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 20, right: 20, bottom: 30, left: 10 } },
            plugins: {
                legend: { labels: { color: '#ccc' } },
                tooltip: {
                    backgroundColor: '#111',
                    titleColor: '#84ff00',
                    bodyColor: '#fff',
                    callbacks: {
                        label: function(context) {
                            return 'KES ' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: { ticks: { color: '#aaa', padding: 10 }, grid: { color: 'rgba(255,255,255,0.05)' } },
                y: { ticks: { color: '#aaa', padding: 10 }, grid: { color: 'rgba(255,255,255,0.05)' } }
            }
        }
    });

    // ===============================
    // 3. RETURN BREAKDOWN (Doughnut)
    // ===============================
    const ctxDoughnut = document.getElementById('yieldBreakdownChart').getContext('2d');
    new Chart(ctxDoughnut, {
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
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': KES ' + context.raw.toLocaleString();
                        }
                    }
                },
                legend: { position: 'bottom' }
            }
        }
    });


    // ===============================
    // 5. Update Overview Cards
    // ===============================
    document.querySelector('.overview-card:nth-child(3) .amount').textContent = 'KES ' + receivedAmount.toLocaleString();
    document.querySelector('.overview-card:nth-child(4) .amount').textContent = 'KES ' + remainingAmount.toLocaleString();
    document.querySelector('.overview-card:nth-child(5) .amount').textContent = progressPercent.toFixed(2) + '%';
    document.querySelector('.overview-card:nth-child(6) .amount').textContent = roiToDate.toFixed(2) + '%';

});
</script>

</body>
</html>
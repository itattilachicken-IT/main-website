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

                    <div class="chart-container small-chart">
                        <h3>Investment Progression</h3>
                        <canvas id="investmentGrowthChart"></canvas>
                      
                    </div>

                    <div class="chart-container small-chart">
                        <h3>Attila Trust Rate</h3>
                        <canvas id="trustGauge"></canvas>
                    </div>

                    <div class="chart-container small-chart">
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

    const payments = @json($payments);
    const totalInvestment = {{ $totalInvestment }};
    const today = new Date().getTime();

    // ===============================
    // 1. PREPARE DATA
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

    const totalReturn = cumulative + remainingAmount;
    const progressPercent = payments.length > 0 ? (receivedCount / payments.length) * 100 : 0;
    const roiToDate = totalInvestment > 0 ? (receivedAmount / totalInvestment) * 100 : 0;

    // ===============================
// 2. TRUST SCORE LOGIC (IMPROVED)
// ===============================
let trustScore = 50; // start neutral

payments.forEach(p => {
    const payDate = new Date(p.payment_date).getTime();

    if (payDate <= today) {
        trustScore += 4;   // reward consistency
    } else {
        trustScore -= 6;   // penalize delay harder
    }
});

// Clamp between 0–100
trustScore = Math.max(0, Math.min(100, trustScore));

// Update UI
const trustEl = document.getElementById('trustScoreValue');
if (trustEl) trustEl.textContent = Math.round(trustScore);


// ===============================
// 3. TRUST GAUGE (NEEDLE + LABELS)
// ===============================
const ctxGauge = document.getElementById('trustGauge').getContext('2d');

const gaugePlugin = {
    id: 'gaugePlugin',
    afterDatasetDraw(chart) {
        const { ctx } = chart;
        const meta = chart.getDatasetMeta(0);

        const centerX = meta.data[0].x;
        const centerY = meta.data[0].y;

        // ===============================
        // NEEDLE
        // ===============================
        const angle = Math.PI + (trustScore / 100) * Math.PI;

        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(angle);

        ctx.beginPath();
        ctx.moveTo(0, -3);
        ctx.lineTo(85, 0);
        ctx.lineTo(0, 3);
        ctx.fillStyle = '#111';
        ctx.fill();

        ctx.restore();

        // center circle
        ctx.beginPath();
        ctx.arc(centerX, centerY, 5, 0, Math.PI * 2);
        ctx.fillStyle = '#666';
        ctx.fill();

        // ===============================
        // LABELS
        // ===============================
        ctx.save();
        ctx.font = 'bold 11px sans-serif';
        ctx.textAlign = 'center';

        const radius = 90;

        // LOW (left)
        ctx.fillStyle = '#ef4444';
        ctx.fillText('LOW', centerX - radius, centerY + 12);

        // NEUTRAL (top)
        ctx.fillStyle = '#facc15';
        ctx.fillText('NEUTRAL', centerX, centerY - radius + 25);

        // HIGH (right)
        ctx.fillStyle = '#22c55e';
        ctx.fillText('HIGH', centerX + radius, centerY + 12);

        ctx.restore();
    }
};


// ===============================
// 4. RENDER GAUGE
// ===============================
new Chart(ctxGauge, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [30, 40, 30], // segments
            backgroundColor: ['#ef4444', '#facc15', '#22c55e'],
            borderWidth: 0,
            cutout: '72%',
            circumference: 180,
            rotation: 270
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: { enabled: false },
            legend: { display: false }
        }
    },
    plugins: [gaugePlugin]
});
    // ===============================
    // 4. LINE CHART
    // ===============================
    const ctxLine = document.getElementById('investmentGrowthChart').getContext('2d');
   
    const gradient = ctxLine.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, '#ffc300');
    gradient.addColorStop(1, '#84ff0005');

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cumulative Return (KES)',
                data: cumulativeData,
                borderColor: '#ffc300',
                backgroundColor: gradient,
                tension: 0.4,
                fill: true,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 20,
                    right: 15,
                    bottom: 35,
                    left: 10
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grace: '10%' // adds space above the highest point
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // ===============================
    // 5. DOUGHNUT BREAKDOWN
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
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ===============================
    // 6. UPDATE CARDS (SAFE)
    // ===============================
    const cards = document.querySelectorAll('.overview-card .amount');

    if (cards.length >= 6) {
        cards[2].textContent = 'KES ' + receivedAmount.toLocaleString();
        cards[3].textContent = 'KES ' + remainingAmount.toLocaleString();
        cards[4].textContent = progressPercent.toFixed(2) + '%';
        cards[5].textContent = roiToDate.toFixed(2) + '%';
    }

});
</script>

</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Investments</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>

<div class="dashboard-layout">

    {{-- Sidebar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

               {{-- Notice --}}
                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        View your current investments, payment schedules, and package details. Stay informed about your investment performance and upcoming payments.
                       
                    </p>
                </div> 
           
            {{-- Investor Investment Table --}}
            <div class="card table-wrapper">
                <table class="investment-table">
                    <thead>
                        <tr>
                            <th>Investment Plan</th>
                            <th>Number of Birds</th>
                            <th>Amount (Ksh)</th>
                            <th>Feeds</th>
                            <th>Cost of Feeds (Ksh)</th>
                            <th>Insurance PCY</th>
                            <th>Total Package Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $investor->investment_package }}</td>
                            <td>{{ number_format($investor->number_of_birds) }}</td>
                            <td>{{ number_format($investor->total_investment) }}</td>
                            <td>{{ number_format($investor->feeds_bags) }}</td>
                            <td>{{ number_format($investor->cost_of_feeds) }}</td>
                            <td>{{ number_format($investor->insurance) }}</td>
                            <td>{{ number_format($investor->total_package_cost) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Payment Schedule --}}
            <div class="card table-wrapper" style="margin-top: 30px;">
                <h3 style="margin-bottom:15px;">{{ $investor->investment_package }} Plan – Payment Schedule</h3>
                <table class="investment-table">
                    <thead>
                        <tr>
                            <th>Placement Date</th>
                            <th>Payment Date</th>
                            <th>Investment Rate (Kes./Bird)</th>
                            <th>Amount (Kes.)</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->placement_date)->format('jS F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('jS F Y') }}</td>
                                <td>{{ number_format($p->rate) }}</td>
                                <td>{{ number_format($p->amount) }}</td>
                                <td>
                                    <span class="status {{ strtolower($p->status) }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No payment schedule available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>
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

                {{-- Investments Table --}}
                <div class="card table-wrapper">
                    <table class="investment-table">
                        <thead>
                            <tr>
                                <th>Investment Plan</th>
                                <th>Number of Birds</th>
                                <th>Amount (Ksh)</th>
                                <th>Feeds</th>
                                <th>Cost of Feeds (KSH)</th>
                                <th>Insurance PCY</th>
                                <th>Total Package Cost</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- Active Investment --}}
                            <tr>
                                <td>Bronze</td>
                                <td>5000</td>
                                <td>500,000</td>
                                <td>2100</td>
                                <td>843,500</td>
                                <td>70,000</td>
                                <td>1,343,500</td>
                                <td><span class="status active">Active</span></td>
                            </tr>

                            {{-- Inactive Investment --}}
                            <tr>
                                <td>Silver</td>
                                <td>5000</td>
                                <td>500,000</td>
                                <td>2100</td>
                                <td>843,500</td>
                                <td>70,000</td>
                                <td>1,343,500</td>
                                <td><span class="status inactive">Inactive</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                {{-- Active Investment Payment Schedule --}}
                <div class="card table-wrapper" style="margin-top: 30px;">
                    <h3 style="margin-bottom:15px;">Bronze Plan – Active Payment Schedule</h3>

                    <table class="investment-table">
                        <thead>
                            <tr>
                                <th>Placement Date</th>
                                <th>Payment Date</th>
                                <th>Investment Rate (Kes./Bird)</th>
                                <th>Amount (Kes.)</th>
                                <th>Type of Transfer</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>6th March 2026</td>
                                <td>20th April 2026</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>Bank Transfer <br> Equity Bank <br> 1180299736893</td>
                                <td><span class="status scheduled">Scheduled</span></td>
                            </tr>

                            <tr>
                                <td>5th May 2026</td>
                                <td>19th June 2026</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>-</td>
                                <td><span class="status pending">Upcoming</span></td>
                            </tr>

                            <tr>
                                <td>4th July 2026</td>
                                <td>18th August 2026</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>-</td>
                                <td><span class="status pending">Upcoming</span></td>
                            </tr>

                            <tr>
                                <td>2nd September 2026</td>
                                <td>17th October 2026</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>-</td>
                                <td><span class="status pending">Upcoming</span></td>
                            </tr>

                            <tr>
                                <td>1st November 2026</td>
                                <td>16th December 2026</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>-</td>
                                <td><span class="status pending">Upcoming</span></td>
                            </tr>

                            <tr>
                                <td>31st December 2026</td>
                                <td>14th February 2027</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>-</td>
                                <td><span class="status pending">Upcoming</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                {{-- Inactive Investment Payment Schedule --}}
                <div class="card table-wrapper" style="margin-top: 30px;">
                    <h3 style="margin-bottom:15px;">Silver Plan – Inactive Payment Schedule</h3>

                    <table class="investment-table">
                        <thead>
                            <tr>
                                <th>Placement Date</th>
                                <th>Payment Date</th>
                                <th>Investment Rate (Kes./Bird)</th>
                                <th>Amount (Kes.)</th>
                                <th>Type of Transfer</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10th January 2025</td>
                                <td>25th February 2025</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>Bank Transfer</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>

                            <tr>
                                <td>10th March 2025</td>
                                <td>24th April 2025</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>Bank Transfer</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>

                            <tr>
                                <td>10th May 2025</td>
                                <td>23rd June 2025</td>
                                <td>35</td>
                                <td>1,050,000</td>
                                <td>Bank Transfer</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>
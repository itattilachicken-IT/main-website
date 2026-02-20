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
                                <th>Investment ID</th>
                                <th>Amount</th>
                                <th>Project</th>
                                <th>Date</th>
                                <th>ROI</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-1023</td>
                                <td>KES 500,000</td>
                                <td>Poultry Farm A</td>
                                <td>12/04/2023</td>
                                <td>18%</td>
                                <td><span class="status active">Active</span></td>
                            </tr>
                            <tr>
                                <td>INV-1024</td>
                                <td>KES 500,000</td>
                                <td>Poultry Farm A</td>
                                <td>12/04/2023</td>
                                <td>18%</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>INV-1025</td>
                                <td>KES 500,000</td>
                                <td>Poultry Farm A</td>
                                <td>12/04/2023</td>
                                <td>18%</td>
                                <td><span class="status pending">Pending</span></td>
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

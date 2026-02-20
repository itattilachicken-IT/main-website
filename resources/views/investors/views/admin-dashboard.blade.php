<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/build/assets/app.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard">
       @include('partials.header')

        <main class="content">
            <header class="topbar">
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    <span>Admin</span>
                    <img src="/build/assets/admin-avatar.png" alt="Admin Avatar" class="avatar" />
                </div>
            </header>

            <section class="overview">
                <div class="cards">
                    <div class="card">
                        <h3>Total Capital</h3>
                        <p>KES 95,500,000</p>
                    </div>
                    <div class="card">
                        <h3>Active Investors</h3>
                        <p>112</p>
                    </div>
                    <div class="card">
                        <h3>Avg ROI</h3>
                        <p>16.4%</p>
                    </div>
                    <div class="card">
                        <h3>Risk Exposure</h3>
                        <p>High</p>
                    </div>
                </div>
            </section>

            <section class="charts">
                <div class="grid">
                    <div class="panel">
                        <h2>Capital Inflow vs Outflow</h2>
                        <canvas id="capitalChart"></canvas>
                    </div>

                    <div class="panel">
                        <h2>Investor Risk Levels</h2>
                        <canvas id="riskChart"></canvas>
                    </div>
                </div>

                <div class="panel" style="margin-top:20px;">
                    <h2>Payment Status</h2>
                    <canvas id="paymentChart"></canvas>
                </div>
            </section>
        </main>
    </div>

    <script>
        const capitalCtx = document.getElementById('capitalChart');
        new Chart(capitalCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Inflow',
                        data: [100, 200, 150, 300, 250, 400],
                        borderColor: 'green',
                        fill: false,
                    },
                    {
                        label: 'Outflow',
                        data: [80, 150, 100, 200, 180, 300],
                        borderColor: 'red',
                        fill: false,
                    }
                ]
            }
        });

        const riskCtx = document.getElementById('riskChart');
        new Chart(riskCtx, {
            type: 'bar',
            data: {
                labels: ['Low', 'Medium', 'High'],
                datasets: [{
                    data: [50, 30, 20],
                    backgroundColor: ['#4BC0C0', '#FFCE56', '#FF6384'],
                }]
            }
        });

        const paymentCtx = document.getElementById('paymentChart');
        new Chart(paymentCtx, {
            type: 'bar',
            data: {
                labels: ['Paid', 'Pending', 'Overdue'],
                datasets: [{
                    data: [150, 50, 20],
                    backgroundColor: ['#4BC0C0', '#FFCE56', '#FF6384'],
                }]
            }
        });
    </script>
</body>
</html>
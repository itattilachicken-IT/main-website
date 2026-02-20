<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SEC Filings — Investor Relations</title>

@vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
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

       

                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        Select the filing type and date range you wish to view from the drop-down menus below.
                        <a href="#" style="color:#7c3aaa;">Notice to users.</a>
                    </p>
                </div>

                {{-- Filters --}}
                <div class="card" style="margin-bottom: 30px;">
                    <div class="filters">

                        <div class="filter-group">

                            <label>View
                                <select>
                                    <option>All Filings</option>
                                    <option>Onboarding Contracts</option>
                                    <option>Offboarding Contracts</option>
                                    <option>Payment Reports</option>
                                    <option>Other</option>
                                </select>
                            </label>

                            <label>Year
                                <select>
                                    <option>Trailing 12-Months</option>
                                    <option>2026</option>
                                    <option>2025</option>
                                    <option>2024</option>
                                </select>
                            </label>

                        </div>

                        <div class="ticker">
                            ATTILA: OFFICIAL
                        </div>

                    </div>
                </div>

                {{-- Table Card --}}
                <div class="card">

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th style="width:120px;">Form</th>
                                    <th>Description</th>
                                    <th style="width:120px;">Date</th>
                                    <th style="width:150px;">Format</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Onboarding Contracts</td>
                                    <td>Quarterly report which provides a continuing view of a company’s financial position</td>
                                    <td>Feb 5, 2026</td>
                                    <td class="format-icons">
                                        
                                        <span>PDF</span>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>Offboarding Contracts</td>
                                    <td>Report of unscheduled material events or corporate event</td>
                                    <td>Feb 5, 2026</td>
                                    <td class="format-icons">
                                       
                                        <span>PDF</span>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>Offboarding Contracts</td>
                                    <td>Official notification to shareholders of matters to be brought to vote (“Proxy”)</td>
                                    <td>Jan 22, 2026</td>
                                    <td class="format-icons">
                                       
                                        <span>PDF</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment Report</td>
                                    <td>Annual report which provides a comprehensive overview of the company for the past year</td>
                                    <td>Dec 11, 2025</td>
                                    <td class="format-icons">
                                       
                                        <span>PDF</span>
                                      
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other</td>
                                    <td>Statement of changes in beneficial ownership of securities</td>
                                    <td>Nov 4, 2025</td>
                                    <td class="format-icons">
                                        <span>PDF</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- Pagination --}}
                <div class="pagination">
                    <a href="#">1-25</a>
                    <a href="#">26-28</a>
                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>

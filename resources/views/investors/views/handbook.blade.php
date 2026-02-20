<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Investor Handbook — Attila Chicken</title>

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

               

                <div class="handbook-layout">
                  

                    {{-- Side Navigation --}}
                    <aside class="handbook-nav">
                        <a href="#" data-section="overview" class="nav-link2 actived">Overview</a>
                        <a href="#" data-section="eligibility" class="nav-link2">Eligibility</a>
                        <a href="#" data-section="how" class="nav-link2">How Investments Work</a>
                        <a href="#" data-section="returns" class="nav-link2">Returns</a>
                        <a href="#" data-section="risks" class="nav-link2">Risks</a>
                        <a href="#" data-section="legal" class="nav-link2">Legal</a>
                        <a href="#" data-section="faq" class="nav-link2">FAQs</a>
                    </aside>

                    {{-- Content --}}
                    <div class="handbook-content">

                        <div id="overview" class="handbook-section actived">
                            <h3>Overview</h3>
                            <p>
                                Attila Chicken offers structured agricultural investment opportunities
                                designed to provide stable and transparent returns to investors.
                            </p>
                        </div>

                        <div id="eligibility" class="handbook-section">
                            <h3>Eligibility</h3>
                            <p>
                                Investors must be at least 18 years old and complete KYC verification
                                before participating in any investment project.
                            </p>
                        </div>

                        <div id="how" class="handbook-section">
                            <h3>How Investments Work</h3>
                            <p>
                                Investors select available projects, review projected returns,
                                fund investments, and track performance through the dashboard.
                            </p>
                        </div>

                        <div id="returns" class="handbook-section">
                            <h3>Returns</h3>
                            <p>
                                Returns depend on project performance and are distributed
                                periodically based on agreed schedules.
                            </p>
                        </div>

                        <div id="risks" class="handbook-section">
                            <h3>Risks</h3>
                            <p>
                                Agricultural investments are subject to market, weather,
                                operational, and economic risks. Investors should review all
                                disclosures before committing funds.
                            </p>
                        </div>

                        <div id="legal" class="handbook-section">
                            <h3>Legal</h3>
                            <p>
                                All investments are governed by applicable financial and
                                agricultural regulations. Terms and agreements are provided
                                prior to investment.
                            </p>
                        </div>

                        <div id="faq" class="handbook-section">
                            <h3>FAQs</h3>
                            <p><strong>How do I invest?</strong><br>Use the dashboard to select a project.</p>
                            <p><strong>When are returns paid?</strong><br>According to project schedules.</p>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </main>

</div>



</body>
</html>
<script></script>
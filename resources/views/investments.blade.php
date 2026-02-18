{{-- resources/views/investment.blade.php --}}
@extends('layouts.app')

@section('title', 'Attila Poultry Farm Investment - Attila Chicken')

@section('content')

<div class="container my-1">
    <div class="card shadow-lg rounded-4 p-2">
        @include('investments.partials.hero-slider')

        <p class="lead text-center">
            Attila Poultry Farm gives you an opportunity to grow your wealth by
            partnering in premium quality chicken farming. By investing with us,
            you enjoy guaranteed annual returns,
            making poultry farming a safe and profitable venture for investors.
        </p>

        {{-- General Explanation --}}
        <h2 class="mt-2 mb-2">How the Investment Works</h2>
        <p>
            When you invest with Attila Poultry Farm, your funds are directed
            towards large-scale chicken farming operations. The farm focuses on
            raising premium quality poultry, meeting the growing demand for
            chicken in Kenya and beyond.  Within 15 days of signing your contract, 
            we prepare our coops, acquire the best feed, and place healthy chicks to kick off the farming cycle. 
            Your first payout is made 45 days after such a placement, roughly 60 days after signing the contract. A similar birds' placement is made 15 days after each payout 
            and a subsequent payout 45 days later, and the cycle continues. </p>
            
            <h3>Here is a sample payment schedule for a contract signed on 1st January 2026; </h3>
            
            
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

    :root {
        --brand-red: #fe0000;
        --brand-yellow: #ffc600;
        --brand-black: #000000;
        --navbar-bg: #ffffff;
        --light-gray: #f9f9f9;
    }

    table.investment-schedule {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Montserrat', sans-serif;
        margin: 20px 0;
    }

    table.investment-schedule th,
    table.investment-schedule td {
        border: 1px solid var(--brand-black);
        padding: 12px 15px;
        text-align: center;
        vertical-align: top;
    }

    table.investment-schedule th {
        background-color: var(--brand-red);
        color: var(--navbar-bg);
        font-weight: 600;
    }

    table.investment-schedule tbody tr:nth-child(even) {
        background-color: var(--light-gray);
    }

    table.investment-schedule tbody tr:hover {
        background-color: var(--brand-yellow);
    }

    table.investment-schedule td {
        font-weight: 400;
        font-size: 0.95em;
        color: var(--brand-black);
    }

    table.investment-schedule td small {
        display: block;
        font-size: 0.85em;
        color: #555;
        margin-top: 3px;
    }
</style>

<table class="investment-schedule">
    <thead>
        <tr>
            <th>60-day Cycles</th>
            
            <th>Scheduled Payouts</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            
            <td><b>1st Mar 2026</b></td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>30th Apr 2026</b></td>
        </tr>
        <tr>
            <td>3</td>
            
            <td><b>29th Jun 2026</b></td>
        </tr>
        <tr>
            <td>4</td>
            
            <td><b>28th Aug 2026</b></td>
        </tr>
        <tr>
            <td>5</td>
            
            <td><b>27th Oct 2026</b></td>
        </tr>
        <tr>
            <td>6</td>
            
            <td><b>26th Dec 2026</b></td>
        </tr>
    </tbody>
</table>

            
            
            <p>After a full 12-month investment term, you’ll receive your initial investment or you can choose to re-invest. To Join Attila Poultry Farm and watch your investment grow from the ground up, our model is simple:
        </p>
       <ul class="space-y-4 font-sans text-black text-lg">
    <li>
        <strong>Choose Your Package:</strong> Select one of our three investment plans – <span class="text-red-600 font-semibold">Gold</span>, <span class="text-yellow-600 font-semibold">Silver</span>, or <span class="text-black font-semibold">Bronze</span> – based on your investment goals.
    </li>
    <li>
        <strong>Sign the Contract & Make Your Investment:</strong> Complete and sign the investment agreement and pay the investment amount. This gives us the go-ahead to start your poultry placement.
    </li>
    <li>
        <strong>We Handle the Placement:</strong> Within 15 days of receiving your contract and payment, our team prepares the coops, acquires premium feed, and places healthy chicks to kick off the farming cycle. You don’t need to take any further action.
    </li>
    <li>
        <strong>First Payout:</strong> Your first payout is made <strong>45 days after the first placement</strong>—roughly 60 days after signing the contract.
    </li>
    <li>
        <strong>Subsequent Placements & Payouts:</strong> After each payout, a new batch of birds is placed 15 days later, generating a payout 45 days after placement. This cycle continues automatically throughout the investment period.
    </li>
    <li>
        <strong>Returns:</strong> Your returns are as agreed upon in your signed contract.
    </li>
</ul>


        
        

      {{-- Packages --}}
<h2 class="mt-5 mb-3 text-center">Investment Packages</h2>
<p class="text-center mb-4">
    Attila Poultry Farm offers three distinct investment tiers designed to cater to investors with different levels of capital.
    Returns for each package are as agreed upon in your signed contract.
</p>

<div class="row g-4">
    {{-- Gold Package --}}
    <div class="col-md-4">
        <div class="card border-warning h-100 shadow-sm">
            <div class="card-header text-center bg-warning text-dark fw-bold">
                Gold
            </div>
            <div class="card-body text-center">
                <p class="h5 mb-2">Initial Investment: <strong>KSH 7,830,000</strong></p>
                <p class="h6 mb-2">Number of Birds: <strong>20,000</strong></p>
                <p class="text-muted small">Designed for investors with higher capital seeking maximum exposure. Returns as agreed in your signed contract.</p>
                <!--<a href="/investor/register" class="btn btn-warning mt-3">Invest in Gold</a>-->
            </div>
        </div>
    </div>

    {{-- Silver Package --}}
    <div class="col-md-4">
        <div class="card border-secondary h-100 shadow-sm">
            <div class="card-header text-center bg-secondary text-white fw-bold">
                Silver
            </div>
            <div class="card-body text-center">
                <p class="h5 mb-2">Initial Investment: <strong>KSH 3,915,000</strong></p>
                <p class="h6 mb-2">Number of Birds: <strong>10,000</strong></p>
                <p class="text-muted small">Suitable for mid-level investors. Returns as agreed in your signed contract.</p>
                <!--<a href="/investor/register" class="btn btn-secondary mt-3">Invest in Silver</a>-->
            </div>
        </div>
    </div>

    {{-- Bronze Package --}}
    <div class="col-md-4">
        <div class="card border-brown h-100 shadow-sm" style="border-color:brown;">
            <div class="card-header text-center" style="background-color:brown; color:white; font-weight:600;">
                Bronze
            </div>
            <div class="card-body text-center">
                <p class="h5 mb-2">Initial Investment: <strong>KSH 1,957,500</strong></p>
                <p class="h6 mb-2">Number of Birds: <strong>5,000</strong></p>
                <p class="text-muted small">Entry point for smaller investors. Returns as agreed in your signed contract.</p>
                <!--<a href="/investor/register" class="btn btn-dark mt-3">Invest in Bronze</a>-->
            </div>
        </div>
    </div>
</div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
    --navbar-bg: #ffffff;
}

.promo-section {
    font-family: 'Montserrat', sans-serif;
    background: var(--brand-red);
    color: var(--navbar-bg);
    padding: 20px 10px;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    position: relative;
    overflow: hidden;
}

.promo-section h2 {
    font-size: 2em;
    margin: 0 0 15px;
    font-weight: 600;
}

.promo-section p {
    font-size: 1.2em;
    margin: 0 0 30px;
}

.countdown-circle {
    width: 120px;
    height: 120px;
    margin: 10px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5em;
    font-weight: 600;
    color: var(--navbar-bg);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: transform 0.3s;
}

.countdown-circle:hover {
    transform: scale(1.1);
}

.circles-wrapper {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

@media (max-width: 600px) {
    .countdown-circle { width: 90px; height: 90px; font-size: 1.2em; }
}
</style>

<div class="mt-2 mb-2 promo-section">
    <h2>Capacity Overview - 300,000 birds (Bronze (5,000 per slot))</h2>
    <div class="circles-wrapper">
        <div class="countdown-circle" id="circle-total" style="background-color: var(--brand-yellow); color:black">60 Total Slots</div>
       <div class="countdown-circle" id="circle-taken" style="background-color: white; color: black;">
  10 Taken Slots
</div>

        <div class="countdown-circle" id="circle-remaining" style="background-color: var(--brand-black);">50 Remaining Slots</div>
    </div>
    <h3>You can take more than one slot if you choose gold or silver packages</h3>
</div>

<script>
let totalSlots = 60;
let slotsTaken = 10;
let slotsRemaining = totalSlots - slotsTaken;

const circleTotal = document.getElementById('circle-total');
const circleTaken = document.getElementById('circle-taken');
const circleRemaining = document.getElementById('circle-remaining');

function updateCircles() {
    circleTotal.textContent = totalSlots Total Slots;
    circleTaken.textContent = slotsTaken;
    circleRemaining.textContent = slotsRemaining;
}

// Initial render
updateCircles();

// Example dynamic update (reserve 1 slot)
// setTimeout(() => { slotsTaken += 1; slotsRemaining -= 1; updateCircles(); }, 3000);
</script>


        {{-- Safety & Trust --}}
<h2 class="mt-5 mb-3">Why Invest with Attila Poultry Farm?</h2>
<ul class="space-y-2 text-lg font-sans text-black">
    <li><strong>Proven Poultry Business:</strong> Attila specializes in premium quality chicken production with a track record of professional farm management.</li>
    <li><strong>Agreed Returns:</strong> Your returns are clearly defined in your signed contract, providing transparency and peace of mind.</li>
    <li><strong>Flexible Entry Levels:</strong> Choose between Gold, Silver, or Bronze depending on your available capital.</li>
    <li><strong>Clear Structure:</strong> Capital and agreed returns are paid out after every 45 days, with no hidden deductions.</li>
</ul>


        {{-- Contact --}}
        <h2 class="mt-5 mb-3">Get in Touch</h2>
        <p>If you’re ready to invest or want to learn more, reach out using the following channels:</p>
        <ul class="list-unstyled">
            <li><strong>Phone:</strong> <a href="tel:+254700354354">+254 700 354 354</a></li>
            <li><strong>Email:</strong> <a href="mailto:info@attilachicken.com">info@attilachicken.com</a></li>
            <li><strong>Website:</strong> <a href="https://attilachicken.com" target="_blank">www.attillachicken.com</a></li>
        </ul>

        {{-- Disclaimer --}}
        <div class="alert mt-2" style="background-color: #ffc600; color: #000000; border: none;">
    <strong>Note:</strong> This is an investment opportunity with Attila Poultry Farm. Please understand the terms before
    committing funds since the returns are calculated based on the agreed package.
</div>

    
</div>
@endsection

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Investor Onboarding</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')

    <link rel="stylesheet" href="{{ asset('css/admin-extra.css') }}">

 
</head>

<body>

<div class="dashboard-layout">



    {{-- Sidebar --}} 
    <aside class="sidebar" id="sidebar"> 
        {{-- Logo Section --}} 
        <div class="sidebar-brand"> 
            <div class="brand-icon">A</div> 
            <div class="brand-text"> 
                <h2 class="logo-text">ATTILA</h2> 
                <span>Admin Portal</span> 
            </div> 
            <button class="collapse-btn" onclick="toggleSidebar()" aria-label="Toggle sidebar">☰</button> 
        </div> 
        <nav class="sidebar-nav"> 
            <a href="{{ url('investors/views/admin-dashboard') }}" class="nav-link"> 
                <span>👤</span> <span class="link-text">Investor Onboarding</span> 
            </a> 
            <a href="{{ url('investors/views/investors') }}" class="nav-link"> 
                <span>💼</span> <span class="link-text">Investors</span> 
            </a> 
            <a href="{{ url('investors/views/events') }}" class="nav-link"> 
                <span>📅</span> <span class="link-text">Events</span> 
            </a> 
            <a href="{{ url('investors/views/files') }}" class="nav-link"> 
                <span>📂</span> <span class="link-text">SEC Filings</span> 
            </a> 
            <a href="{{ url('investors/views/reports') }}" class="nav-link"> 
                <span>📊</span> <span class="link-text">Annual Reports</span> 
            </a> 
            <a href="{{ url('investors/views/accountsettings') }}" class="nav-link"> 
                <span>⚙️</span> <span class="link-text">Settings</span> 
            </a> 
        </nav> 
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

      {{-- Topbar --}} <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <h2 class="page-title">Create Investor Account</h2> 
        </div> <div class="topbar-right"> 
            <div class="search-box"> 
                <input type="text" placeholder="Search..." /> 
            </div> <div class="user-profile"> 
                <img src="https://i.pravatar.cc/40" alt="User" class="avatar"> 
                <div class="user-meta"> 
                    <div class="user-name">Admin</div> 
                </div> 
            </div> 
            <form action="{{ route('investor.logout') }}" method="POST"> @csrf 
                <button type="submit" class="btn-secondary">Logout</button>
             </form> 
            </div> 
        </div>

        <section class="section">
            <div class="container">

                <div class="onboarding-card">

                    <!-- STEP INDICATOR -->
                    <div class="step-indicator">
                        <div class="step active">1. Account</div>
                        <div class="step">2. Contract</div>
                        <div class="step">3. Bank</div>
                        <div class="step">4. Upload</div>
                    </div>

                    <form id="onboardingForm">

                        <!-- STEP 1 -->
                        <div class="form-step active" id="step-1">
                            <h3>Create Investor Account</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Investor Code</label>
                                    <input type="text" placeholder="e.g. ATP-001">
                                </div>
                                <div>
                                    <label>Full Name</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input type="email">
                                </div>
                                <div>
                                    <label>Phone</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Temporary Password</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2 -->
                        <div class="form-step" id="step-2">
                            <h3>Contract & Investment Details</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Investment Package</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Number of Birds</label>
                                    <input type="number">
                                </div>
                                <div>
                                    <label>Feeds (Bags)</label>
                                    <input type="number">
                                </div>
                                <div>
                                    <label>Cost of Feeds (KSH)</label>
                                    <input type="number">
                                </div>
                                <div>
                                    <label>Insurance (KES)</label>
                                    <input type="number">
                                </div>
                                <div>
                                    <label>Total Investment (KES)</label>
                                    <input type="number">
                                </div>
                                <div>
                                    <label>Total Package Cost (KES)</label>
                                    <input type="number">
                                </div>
                            </div>

                            <!-- PAYMENT SCHEDULE -->
                            <div class="payment-schedule">
                                <h4>Payment Schedule</h4>

                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Placement Date</th>
                                            <th>Payment Date</th>
                                            <th>Rate (KES/Bird)</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="paymentRows">
                                        <tr>
                                            <td><input type="date"></td>
                                            <td><input type="date"></td>
                                            <td><input type="text" value="35"></td>
                                            <td><input type="number"></td>
                                            <td>
                                                <select>
                                                    <option>Scheduled</option>
                                                    <option>In Progress</option>
                                                    <option>Paid</option>
                                                    <option>Not Paid</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" onclick="removeRow(this)">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="button" class="btn-secondary" onclick="addPaymentRow()">+ Add Payment Schedule</button>
                            </div>
                        </div>

                        <!-- STEP 3 -->
                        <div class="form-step" id="step-3">
                            <h3>Investor Bank Details</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Bank Name</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Bank Address</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Account Name</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Account Number</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Swift Code</label>
                                    <input type="text">
                                </div>
                                <div>
                                    <label>Branch Name</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4 -->
                        <div class="form-step" id="step-4">
                            <h3>Upload Signed Contract</h3>

                            <div class="upload-box">
                                <input type="file" accept="application/pdf">
                                <p>Upload signed PDF contract</p>
                            </div>
                        </div>

                        <!-- NAVIGATION -->
                        <div class="wizard-navigation">
                            <button type="button" class="btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>

                    </form>

                </div>
            </div>
        </section>
    </main>
</div>

<script>

let currentStep = 1;
showStep(currentStep);

function showStep(n){
    let steps = document.querySelectorAll(".form-step");
    let indicators = document.querySelectorAll(".step");

    steps.forEach(s => s.classList.remove("active"));
    indicators.forEach(s => s.classList.remove("active"));

    document.getElementById("step-"+n).classList.add("active");
    indicators[n-1].classList.add("active");

    document.getElementById("prevBtn").style.display = n==1?"none":"inline-block";
    document.getElementById("nextBtn").innerHTML = n==4?"Finish":"Next";
}

function nextPrev(n){
    currentStep += n;
    if(currentStep > 4){
        alert("Onboarding Complete (Frontend Only)");
        currentStep = 4;
        return;
    }
    if(currentStep < 1) currentStep = 1;
    showStep(currentStep);
}

function addPaymentRow(){
    let table = document.getElementById("paymentRows");
    let row = table.insertRow();
    row.innerHTML = `
        <td><input type="date"></td>
        <td><input type="date"></td>
        <td><input type="text" value="KES 35/Bird"></td>
        <td><input type="number"></td>
        <td>
            <select>
                <option>Scheduled</option>
                <option>In Progress</option>
                <option>Paid</option>
                <option>Not Paid</option>
            </select>
        </td>
        <td><button type="button" onclick="removeRow(this)">X</button></td>
    `;
}

function removeRow(btn){
    btn.closest("tr").remove();
}

function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('collapsed');
}

</script>

</body>
</html>
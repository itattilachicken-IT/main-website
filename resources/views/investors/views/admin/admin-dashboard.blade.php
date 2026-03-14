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
                <span>💼</span> <span class="link-text">Investor Onboarding</span> 
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
               <div class="nav-dropdown">

        <button class="nav-link dropdown-toggle" onclick="toggleDropdown()" type="button">
            <span>⚙️</span>
            <span class="link-text">Settings</span>
            <span class="arrow">▾</span>
        </button>

        <div class="dropdown-menu" id="settingsDropdown">

            <a href="{{ url('investors/views/accountsettings') }}" class="dropdown-item">
                Account Settings
            </a>

            <form action="{{ route('investor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item logout-btn">
                    Logout
                </button>
            </form>

        </div>

    </div>
 
        </nav> 
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

           {{-- Topbar --}} 
    <div class="dashboard-topbar"> 
        
        <div class="topbar-left"> 
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Create Account</h2> 
        </div> <div class="topbar-right"> 
            
            <div class="user-profile"> 
                <div class="avatar-initial">
                    {{ strtoupper(substr(session('investor_name', 'A'), 0, 1)) }}
                </div> 
                <div class="user-meta"> 
                    <div class="user-name"> {{ session('investor_name', 'Admin') }}</div> 
                </div> 
            </div> 
         
            </div> 
    </div>

        <section class="section">
            <div class="container">

            {{-- CREATE INVESTOR TOGGLE --}}
                <div class="card" style="margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                       
                        <button class="btn-primary" type="button" onclick="toggleOnboarding()">
                            + New Investor
                        </button>
                    </div>
                </div>
            
                <div class="onboarding-card" id="onboardingSection" style="display:none;">

                    <!-- STEP INDICATOR -->
                    <div class="step-indicator">
                        <div class="step active">1. Account</div>
                        <div class="step">2. Contract</div>
                        <div class="step">3. Bank</div>
                        <div class="step">4. Upload</div>
                    </div>

                    <form id="onboardingForm" method="POST" action="{{ route('investors.store') }}" enctype="multipart/form-data">
                    @csrf

                        <!-- STEP 1 -->
                        <div class="form-step active" id="step-1">
                            <h3>Create Investor Account</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Investor Code</label>
                                    <input type="text" name="investor_code" placeholder="e.g. ATP-001">
                                </div>
                                <div>
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" placeholder="e.g. John Doe">
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="e.g. john@example.com">
                                </div>
                                <div>
                                    <label>Phone</label>
                                    <input type="text" name="phone" placeholder="e.g. 0700123456">
                                </div>
                                <div>
                                    <label>Temporary Password</label>
                                    <input type="text" name="password" placeholder="e.g. Temp@1234">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2 -->
                        <div class="form-step" id="step-2">
                            <h3>Contract & Investment Details</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Investment Package</label>
                                    <input type="text" name="investment_package" placeholder="e.g. Bronze, Silver, Gold">
                                </div>
                                <div>
                                    <label>Number of Birds</label>
                                    <input type="number" name="number_of_birds" placeholder="e.g. 5000">
                                </div>
                                <div>
                                    <label>Feeds (Bags)</label>
                                    <input type="number" name="feeds_bags" placeholder="e.g. 100">
                                </div>
                                <div>
                                    <label>Cost of Feeds (KSH)</label>
                                    <input type="number" name="cost_of_feeds" placeholder="e.g. 65000">
                                </div>
                                <div>
                                    <label>Insurance (KES)</label>
                                    <input type="number" name="insurance" placeholder="e.g. 90000">
                                </div>
                                <div>
                                    <label>Total Investment (KES)</label>
                                    <input type="number" name="total_investment" placeholder="e.g. 155000">
                                </div>
                                <div>
                                    <label>Total Package Cost (KES)</label>
                                    <input type="number" name="total_package_cost" placeholder="e.g. 255000">
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
                                            <td><input type="date" name="placement_date[]"></td>
                                            <td><input type="date" name="payment_date[]"></td>
                                            <td><input type="text" value="35" name="rate[]"></td>
                                            <td><input type="number" name="amount[]"></td>
                                            <td>
                                                <select name="status[]">
                                                    <option>Scheduled</option>
                                                    <option>In Progress</option>
                                                    <option>Paid</option>
                                                    <option>Not Paid</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" onclick="removeRow(this)" class="btn-primary">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="button" class="btn-edit" onclick="addPaymentRow()">+ Add Payment Schedule</button>
                            </div>
                        </div>

                        <!-- STEP 3 -->
                        <div class="form-step" id="step-3">
                            <h3>Investor Bank Details</h3>

                            <div class="form-grid">
                                <div>
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" placeholder="e.g. Equity Bank">
                                </div>
                                <div>
                                    <label>Bank Address</label>
                                    <input type="text" name="bank_address" placeholder="e.g. Nairobi">
                                </div>
                                <div>
                                    <label>Account Name</label>
                                    <input type="text" name="account_name" placeholder="e.g. John Mwangi">
                                </div>
                                <div>
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" placeholder="e.g. 123456789">
                                </div>
                                <div>
                                    <label>Swift Code</label>
                                    <input type="text" name="swift_code" placeholder="e.g. EQTYKENX">
                                </div>
                                <div>
                                    <label>Branch Name</label>
                                    <input type="text" name="branch_name" placeholder="e.g. Thika Branch">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4 -->
                        <div class="form-step" id="step-4">
                            <h3>Upload Signed Contract</h3>

                            <div class="upload-box">
                                <input type="file" name="contract_file" accept="application/pdf">
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
                
              {{-- CURRENT INVESTORS --}}
            <div class="card" style="margin-top:30px;">
                <h3 style="margin-bottom:15px;">Current Onboarded Investors</h3>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Investor Code</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Investment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        @if(isset($investors) && $investors->count() > 0)

                            @foreach($investors as $investor)

                            <tr>
                                <td>{{ $investor->investor_code ?? '-' }}</td>

                                <td>{{ $investor->full_name ?? '-' }}</td>

                                <td>{{ $investor->email ?? '-' }}</td>

                                <td>{{ $investor->phone ?? '-' }}</td>

                                <td>
                                    KES {{ number_format($investor->total_investment ?? 0) }}
                                </td>

                                <td>
                                    <span class="status-badge 
                                        {{ ($investor->status ?? 'Active') == 'Active' ? 'status-active' : 'status-pending' }}">
                                        
                                        {{ $investor->status ?? 'Active' }}

                                    </span>
                                </td>

                                <td>
                                    <div class="action-buttons">

                                     

                                        {{-- Edit --}}
                                        <!-- <a href="{{ url('investors/edit/'.$investor->id) }}" 
                                        class="btn-edit">
                                            Edit
                                        </a> -->

                                        <a class="btn-edit" onclick="togglePayments('payments-{{ $investor->id }}')">
                                        View
                                    </a>

                                        {{-- Delete --}}
                                        <form action="{{ url('investors/delete/'.$investor->id) }}" 
                                            method="POST" 
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Delete this investor?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                Delete
                                            </button>

                                        </form>
                                        

                                    </div>
                                </td>

                            </tr>
                            <tr id="payments-{{ $investor->id }}" class="payments-row" style="display:none;">
                                <td colspan="7">
                                    <div class="payments-dropdown">
                                        <table class="admin-table">
                                            <thead>
                                                <tr>
                                                    <th>Placement Date</th>
                                                    <th>Payment Date</th>
                                                    <th>Rate (KES/Bird)</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(DB::table('investor_payments')->where('investor_code', $investor->investor_code)->orderBy('placement_date')->get() as $payment)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($payment->placement_date)->format('jS F Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('jS F Y') }}</td>
                                                    <td>{{ number_format($payment->rate) }}</td>
                                                    <td>{{ number_format($payment->amount) }}</td>
                                                    <td>
                                                        <select class="payment-status" data-id="{{ $payment->id }}">
                                                            <option value="Paid" {{ $payment->status === 'Paid' ? 'selected' : '' }}>Paid</option>
                                                            <option value="Upcoming" {{ $payment->status === 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn-edit" onclick="updatePaymentStatus({{ $payment->id }})">
                                                            Update
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="7" style="text-align:center;padding:20px;">
                                    No investors onboarded yet
                                </td>
                            </tr>

                        @endif

                        </tbody>

                    </table>
                </div>
            </div>

            </div>
        </section>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.nav-link');
        const pageTitle = document.querySelector('.page-title');

        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('activated');

                // Set page title from data attribute
                const customTitle = link.getAttribute('data-title');
                if (customTitle && pageTitle) {
                    pageTitle.innerHTML = customTitle;
                }
            }
        });

        // Restore sidebar collapsed state
        const sidebar = document.getElementById('sidebar');
        try {
            const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (collapsed) sidebar.classList.add('collapsed');
        } catch (e) {}
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
        try {
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        } catch (e) {}
    }


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
        
        document.getElementById("onboardingForm").submit();
        return;
    }
    if(currentStep < 1) currentStep = 1;
    showStep(currentStep);
}

function addPaymentRow(){
    let table = document.getElementById("paymentRows");
    let row = table.insertRow();
    row.innerHTML = `
        <td><input type="date" name="placement_date[]"></td>
        <td><input type="date" name="payment_date[]"></td>
        <td><input type="text" name="rate[]" value="35"></td>
        <td><input type="number" name="amount[]"></td>
        <td>
            <select name="status[]">
                <option>Scheduled</option>
                <option>In Progress</option>
                <option>Paid</option>
                <option>Not Paid</option>
            </select>
        </td>
        <td>
            <button type="button" onclick="removeRow(this)" class="btn-primary">X</button>
        </td>
    `;
}

function removeRow(btn){
    btn.closest("tr").remove();
}

function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('collapsed');
}
function toggleOnboarding(){
    const section = document.getElementById("onboardingSection");
    section.style.display = section.style.display==="none"?"block":"none";
}

function toggleDropdown(){
    document.getElementById("settingsDropdown")
        .classList.toggle("show");
}

window.addEventListener("click", function(e){
    if(!e.target.closest(".nav-dropdown")){
        document.getElementById("settingsDropdown")
            .classList.remove("show");
    }
});


function togglePayments(id) {
    const row = document.getElementById(id);
    row.style.display = row.style.display === "none" ? "table-row" : "none";
}

function updatePaymentStatus(paymentId) {
    const select = document.querySelector(`.payment-status[data-id='${paymentId}']`);
    const status = select.value;

    fetch(`/admin/update-payment-status/${paymentId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Payment status updated successfully.');
        } else {
            alert('Failed to update status.');
        }
    })
    .catch(err => console.error(err));
}
</script>

</body>
</html>
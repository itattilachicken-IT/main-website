<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Investor</title>

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
<main class="main-content">
           {{-- Topbar --}} 
      <div class="dashboard-topbar"> 
        
        <div class="topbar-left"> 
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Edite Details</h2> 
        </div> <div class="topbar-right"> 
            
            <div class="user-profile"> 
                <img src="https://i.pravatar.cc/40" alt="User" class="avatar"> 
                <div class="user-meta"> 
                    <div class="user-name">Admin</div> 
                </div> 
            </div> 
         
            </div> 
        </div>
<section class="section">

<div class="container">

<div class="card">

<h3>Edit Investor</h3>

<form method="POST"
action="{{ route('investors.update',$investor->id) }}">

@csrf
@method('PUT')

<div class="form-grid">

<div>
<label>Investor Code</label>
<input type="text"
name="investor_code"
value="{{ $investor->investor_code }}">
</div>

<div>
<label>Full Name</label>
<input type="text"
name="full_name"
value="{{ $investor->full_name }}">
</div>

<div>
<label>Email</label>
<input type="email"
name="email"
value="{{ $investor->email }}">
</div>

<div>
<label>Phone</label>
<input type="text"
name="phone"
value="{{ $investor->phone }}">
</div>

<div>
<label>Investment Package</label>
<input type="text"
name="investment_package"
value="{{ $investor->investment_package }}">
</div>

<div>
<label>Number of Birds</label>
<input type="number"
name="number_of_birds"
value="{{ $investor->number_of_birds }}">
</div>

<div>
<label>Total Investment</label>
<input type="number"
name="total_investment"
value="{{ $investor->total_investment }}">
</div>

</div>


<div style="margin-top:20px">

<button type="submit" class="btn-primary">
Update Investor
</button>

<a href="{{ route('investors.admin.admin-dashboard') }}"
class="btn-secondary">
Cancel
</a>

</div>

</form>

</div>

</div>

</section>

</main>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
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
            <a href="{{ url('investors/views/admin-dashboard') }}" class="nav-link" > 
                <span>👤</span> <span class="link-text">Investor Onboarding</span> 
            </a> 
            <a href="{{ url('investors/views/investors') }}" class="nav-link" > 
                <span>💼</span> <span class="link-text">Investors</span> 
            </a> 
            <a href="{{ url('investors/views/events') }}" class="nav-link" > 
                <span>📅</span> <span class="link-text">Events</span> 
            </a> 
            <a href="{{ url('investors/views/files') }}" class="nav-link" > 
                <span>📂</span> <span class="link-text">SEC Filings</span> 
            </a> 
            <a href="{{ url('investors/views/reports') }}" class="nav-link" > 
                <span>📊</span> <span class="link-text">Annual Reports</span> 
            </a> 
            <a href="{{ url('investors/views/accountsettings') }}" class="nav-link"> 
                <span>⚙️</span> <span class="link-text">Settings</span> 
            </a> 
        </nav> 
    </aside>

    {{-- Main Content --}}
    <main class="main-content">
    {{-- Topbar --}} <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <h2 class="page-title">Change Password</h2> 
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

        <div class="settings-wrapper">




            {{-- Security Section --}}
            <div class="settings-card">
                <h2>Change Password</h2>

                <form method="POST" action="#">
                    @csrf

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password">
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password">
                    </div>

                    <button type="submit" class="btn-primary">Update Password</button>
                </form>
            </div>

      

        </div>
</div>
</div>

    </main>
</div>

</body>
</html>

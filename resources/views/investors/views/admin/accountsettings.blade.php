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
                <span>💼</span> <span class="link-text">Investor Onboarding</span> 
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

    {{-- Main Content --}}
    <main class="main-content">
    {{-- Topbar --}} <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Change Password</h2> 
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

        <div class="settings-wrapper">




            {{-- Security Section --}}
            <div class="settings-card">
                <h2>Change Password</h2>

                    {{-- Display success message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <form method="POST" action="{{ route('admin.adminupdatePassword') }}">
                    @csrf

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn-primary btn-small" style="float:left;">Update Password</button>
                    <br><br>
                </form>
            </div>

      

        </div>
</div>
</div>

    </main>
</div>

</body>
</html>
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

</script>
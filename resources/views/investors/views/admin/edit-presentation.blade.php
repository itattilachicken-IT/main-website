<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Edit Presentation</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')

    <link rel="stylesheet" href="{{ asset('css/admin-extra.css') }}">
</head>

<body>

<div class="dashboard-layout">

    {{-- SIDEBAR --}}
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
            <a href="{{ url('investors/views/news') }}" class="nav-link"> 
                <span>🗞️</span> <span class="link-text">Company Updates</span> 
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

    {{-- MAIN CONTENT --}}
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


        {{-- PAGE CONTENT --}}
        <section class="section">
            <div class="container">

                <div class="admin-card">

                    <h3>Edit Presentation Details</h3>

                    <form method="POST"
                          action="{{ route('admin.presentations.update', $presentation->id) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-grid">

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text"
                                       name="title"
                                       value="{{ $presentation->title }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input type="date"
                                       name="date"
                                       value="{{ $presentation->presentation_date }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label>Replace Image</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <label>Replace PDF</label>
                                <input type="file" name="download_link">
                            </div>

                        </div>

                        {{-- CURRENT FILES --}}
                        <div style="margin-top:20px;">

                            @if($presentation->image)
                                <p><strong>Current Image:</strong></p>
                                <img src="{{ asset('contracts/presentations/'.$presentation->image) }}"
                                     width="120"
                                     style="border-radius:8px;">
                            @endif

                            @if($presentation->pdf_file)
                                <p style="margin-top:10px;">
                                    <strong>Current PDF:</strong>
                                    <a href="{{ asset('contracts/presentations/'.$presentation->pdf_file) }}"
                                       target="_blank"
                                       class="btn-edit">
                                       View PDF
                                    </a>
                                </p>
                            @endif

                        </div>

                        <div style="margin-top:25px;">
                            <button type="submit" class="btn-primary">
                                Update Presentation
                            </button>

                            <a href="{{ route('investors.admin.events') }}"
                               class="btn-secondary"
                               style="margin-left:10px;">
                               Cancel
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </section>

    </main>
</div>


<script>
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('collapsed');
}
</script>

</body>
</html>
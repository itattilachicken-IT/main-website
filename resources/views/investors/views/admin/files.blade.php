<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin — SEC Filings Management</title>

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
            <a href="{{ url('investors/views/accountsettings') }}" class="nav-link"> 
                <span>⚙️</span> <span class="link-text">Settings</span> 
            </a> 
        </nav> 
    </aside>

    {{-- Main Content --}}
    <main class="main-content">
                  {{-- Topbar --}} 
      <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <h2 class="page-title">SEC-File Update</h2> 
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

                {{-- Add Filing Form --}}
                <div class="admin-card">
                    <h2>Add New SEC Filing</h2>

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf

                        <div class="admin-form-grid">

                            <div class="admin-form-group">
                                <label>Filing Type</label>
                                <select name="type">
                                    <option>Onboarding Contracts</option>
                                    <option>Offboarding Contracts</option>
                                    <option>Payment Reports</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="admin-form-group">
                                <label>Filing Date</label>
                                <input type="date" name="date">
                            </div>

                        </div>

                        <div class="admin-form-group">
                            <label>Description</label>
                            <textarea name="description"></textarea>
                        </div>

                        <div class="admin-form-group">
                            <label>Upload PDF File</label>
                            <div class="upload-box">
                                <input type="file" name="pdf_file" accept="application/pdf">
                                <p style="font-size:13px; margin-top:10px;">Upload PDF contract or report</p>
                            </div>
                        </div>

                        <div class="admin-actions">
                            <button type="submit" class="btn-primary">
                                Save Filing
                            </button>
                        </div>

                    </form>
                </div>

                {{-- Existing Filings Table --}}
                <div class="card">

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Form</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Format</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- Static sample rows --}}
                                <tr>
                                    <td>Onboarding Contracts</td>
                                    <td>Quarterly investor onboarding documentation</td>
                                    <td>Feb 5, 2026</td>
                                    <td>PDF</td>
                                    <td>
                                        <div class="admin-controls">
                                            <button class="btn-edit">Edit</button>
                                            <button class="btn-danger">Delete</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Payment Reports</td>
                                    <td>Annual financial distribution report</td>
                                    <td>Dec 11, 2025</td>
                                    <td>PDF</td>
                                    <td>
                                        <div class="admin-controls">
                                            <button class="btn-edit">Edit</button>
                                            <button class="btn-danger">Delete</button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </section>

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
</script>
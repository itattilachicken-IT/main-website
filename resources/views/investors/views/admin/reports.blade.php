<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin — Annual Reports Management</title>

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
            {{-- Topbar --}} 
      <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Annual Reports</h2> 
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

                <div class="admin-header">
                    <h1>Annual Reports Management</h1>
                    <p>Upload and manage official company annual reports.</p>
                </div>

                <div class="admin-layout">

                    {{-- LEFT SIDE: ADD REPORT --}}
                    <div class="card admin-form-card">
                        <h3 style="margin-bottom:15px;">Add New Report</h3>

                        <form class="admin-form" action="{{ route('annual-reports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Report Title</label>
                            <input type="text" name="title" placeholder="e.g. Annual Report 2025" required>

                            <label>Report Date</label>
                            <input type="date" name="date" required>

                            <label>Cover Image</label>
                            <input type="file" name="image" accept="image/*">

                            <label>Upload PDF Report</label>
                            <input type="file" name="file" accept="application/pdf" required>

                            <button type="submit" class="admin-btn">+ Save Report</button>
                        </form>
                    </div>

                    {{-- RIGHT SIDE: EXISTING REPORTS --}}
                    <div class="card">
                        <h3 style="margin-bottom:15px;">Existing Reports</h3>

                        <div class="table-wrapper">
                            <table class="data-table report-table">
                                <thead>
                                    <tr>
                                        <th style="width:80px;">Cover</th>
                                        <th>Title</th>
                                        <th style="width:120px;">Date</th>
                                        <th style="width:120px;">Format</th>
                                        <th style="width:140px;">Actions</th>
                                    </tr>
                                </thead>
                               <tbody>
                                    @forelse ($reports as $report)
                                    <tr>
                                        <td>
                                            @if($report->cover_image)
                                                <img src="{{ asset('contracts/annual-reports/images/'.$report->cover_image) }}" alt="Report Cover" width="60">
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $report->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ asset('contracts/annual-reports/pdfs/'.$report->pdf_file) }}" download="{{ $report->pdf_file }}" class="btn-download">PDF</a>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('annual-reports.download', $report->id) }}" class="btn-edit">Download</a>

                                                <form action="{{ route('annual-reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" style="text-align:center;">No reports available</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
            <div class="pagination" style="margin-top:20px;">
                {{ $reports->links() }}
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
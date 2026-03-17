<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Manage Events & Presentations</title>

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



    <main class="main-content">
                   {{-- Topbar --}} 
      <div class="dashboard-topbar"> 
        <div class="topbar-left"> 
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Events</h2> 
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
                            {{-- Notice --}}
                <div class="card" style="margin-bottom: 24px;">
                    <p class="lead">
                        Add or Edit details for an upcoming event, such as industry conferences. Keep investors informed about our latest activities and strategic initiatives.
                    </p>
                </div>
                <div class="two-column-admin">

                    <!-- ================= EVENTS ================= -->
                    <div class="admin-card">
                        <h3>Add New Event</h3>

                        <form method="POST" action="{{ route('admin.events.store') }}">
                            @csrf

                            <div class="form-grid">

                                <div class="form-group">
                                    <label>Event Title</label>
                                    <input type="text" name="title">
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date">
                                </div>

                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="time" name="time">
                                </div>

                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link">
                                </div>

                            </div>

                            <div class="form-group" style="margin-top:10px;">
                                <label>Description</label>
                                <textarea name="description"></textarea>
                            </div>

                            <button class="btn-primary" id="eventSubmitBtn" type="submit">
                                <span class="btn-text">Save Event</span>

                                <span class="spinner" style="display:none;">
                                    ⏳ Uploading...
                                </span>
                            </button>
                        </form>

                        <!-- Existing Events -->
                      <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ date('d M Y', strtotime($event->event_date)) }}</td>
                                <td>

                                    <a href="{{ route('admin.events.edit', $event->id) }}"
                                    class="btn-edit">Edit</a>

                                    <form action="{{ route('admin.events.delete', $event->id) }}"
                                        method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-delete"
                                                onclick="return confirm('Delete this event?')">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No events found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    </div>

                    <!-- ================= PRESENTATIONS ================= -->
                    <div class="admin-card">
                        <h3>Add New Presentation</h3>

                        <form method="POST" action="{{ route('admin.presentations.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-grid">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title">
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date">
                                </div>

                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="image">
                                </div>

                                <div class="form-group">
                                    <label>Upload Presentation (PDF)</label>
                                    <input type="file" name="download_link">
                                </div>

                            </div>

                            <button class="btn-primary" id="presentationSubmitBtn" type="submit">
                                <span class="btn-text">Save Presentation</span>

                                <span class="spinner" style="display:none;">
                                    ⏳ Uploading...
                                </span>
                            </button>
                        </form>

                        <!-- Existing Presentations -->
                        <table class="admin-table">

                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Preview</th>
                                    <th>PDF</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($presentations as $p)
                                <tr>
                                    <td>{{ $p->title }}</td>

                                    <td>{{ date('d M Y', strtotime($p->presentation_date)) }}</td>

                                    <!-- IMAGE PREVIEW -->
                                    <td>
                                        @if($p->image)
                                            <img src="{{ asset('contracts/presentations/'.$p->image) }}"
                                                width="70"
                                                style="border-radius:6px;">
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <!-- PDF LINK -->
                                    <td>
                                        @if($p->pdf_file)
                                            <a href="{{ asset('contracts/presentations/'.$p->pdf_file) }}"
                                            target="_blank"
                                            class="btn-view">
                                                View PDF
                                            </a>
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <!-- ACTIONS -->
                                    <td>

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.presentations.edit', $p->id) }}"
                                        class="btn-edit">
                                        Edit
                                        </a>
                                        <br><br>

                                        <!-- DELETE -->
                                        <form action="{{ route('admin.presentations.delete', $p->id) }}"
                                            method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn-delete"
                                                    onclick="return confirm('Delete this presentation?')">
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5">No presentations found</td>
                                </tr>
                                @endforelse
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


document.addEventListener('DOMContentLoaded', function () {

    function attachLoader(formSelector, buttonId) {

        const form = document.querySelector(formSelector);
        const btn = document.getElementById(buttonId);

        if (!form || !btn) return;

        form.addEventListener('submit', function () {

            btn.disabled = true;

            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.spinner').style.display = 'inline-block';
        });
    }

    // Attach to both forms
    attachLoader('form[action*="events"]', 'eventSubmitBtn');
    attachLoader('form[action*="presentations"]', 'presentationSubmitBtn');

});


</script>
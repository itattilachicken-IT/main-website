<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Edit Event</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
    <link rel="stylesheet" href="{{ asset('css/admin-extra.css') }}">
</head>
<body>

<div class="dashboard-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">A</div>
            <div class="brand-text">
                <h2 class="logo-text">ATTILA</h2>
                <span>Admin Portal</span>
            </div>
            <button class="collapse-btn" onclick="toggleSidebar()">☰</button>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ url('investors/views/admin-dashboard') }}" class="nav-link">
                💼 Investor Onboarding
            </a>

            <a href="{{ url('investors/views/events') }}" class="nav-link activated">
                📅 Events
            </a>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <div class="dashboard-topbar">
            <div class="topbar-left">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()">☰</button>
                <h2 class="page-title">Edit Event</h2>
            </div>

            <div class="topbar-right">
                <div class="user-profile">
                    <div class="avatar-initial">
                        {{ strtoupper(substr(session('admin_name','A'),0,1)) }}
                    </div>
                    <div class="user-meta">
                        <div class="user-name">{{ session('admin_name','Admin') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAGE CONTENT --}}
        <section class="section">
            <div class="container">

                <div class="admin-card">

                    <h3>Edit Event Details</h3>

                    <form method="POST"
                          action="{{ route('admin.events.update', $event->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">

                            <div class="form-group">
                                <label>Event Title</label>
                                <input type="text" name="title" value="{{ $event->title }}" required>
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" value="{{ $event->event_date }}" required>
                            </div>

                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" name="time" value="{{ $event->event_time }}">
                            </div>

                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" value="{{ $event->link }}">
                            </div>

                            <div class="form-group" style="grid-column: span 2;">
                                <label>Description</label>
                                <textarea name="description">{{ $event->description }}</textarea>
                            </div>

                        </div>

                        <div style="margin-top:20px;">
                            <button type="submit" class="btn-primary">Update Event</button>
                            <a href="{{ route('investors.admin.events') }}" class="btn-secondary" style="margin-left:10px;">Cancel</a>
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
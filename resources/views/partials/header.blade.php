<aside class="sidebar" id="sidebar">

    {{-- Logo Section --}}
    <div class="sidebar-brand">
        <div class="brand-icon">A</div>
        <div class="brand-text">
            <h2 class="logo-text">ATTILA</h2>
            <span>Investor Portal</span>
        </div>
        <button class="collapse-btn" onclick="toggleSidebar()" aria-label="Toggle sidebar">☰</button>
    </div>

    <nav class="sidebar-nav">

        <a href="{{ url('investors/views/home') }}" class="nav-link">
            <span>🏠</span>
            <span class="link-text">Dashboard</span>
        </a>

        <a href="{{ url('investors/views/my-investments') }}" class="nav-link">
            <span>💼</span>
            <span class="link-text">My Investments</span>
        </a>
        <a href="{{ url('investors/views/handbook') }}" class="nav-link">
            <span>📘</span>
            <span class="link-text">Investor Handbook</span>
        </a>

        <a href="{{ url('investors/views/directors') }}" class="nav-link">
            <span>👔</span>
            <span class="link-text">Board of Directors</span>
        </a>

        <a href="{{ url('investors/views/press-releases') }}" class="nav-link">
            <span>🗞️</span>
            <span class="link-text">Press Releases</span>
        </a>

        <a href="{{ url('investors/views/events-and-presentations') }}" class="nav-link">
            <span>📅</span>
            <span class="link-text">Events</span>
        </a>

        <a href="{{ url('investors/views/sec-filings') }}" class="nav-link">
            <span>📂</span>
            <span class="link-text">SEC Filings</span>
        </a>

        <a href="{{ url('investors/views/annual-reports') }}" class="nav-link">
            <span>📊</span>
            <span class="link-text">Annual Reports</span>
        </a>

        <a href="{{ url('investors/views/settings') }}" class="nav-link">
            <span>⚙️</span>
            <span class="link-text">Settings</span>
        </a>

    </nav>
</aside>

<script>
    // Highlight the active navigation link
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('activated');
            }
        });
        // Restore sidebar collapsed state
        const sidebar = document.getElementById('sidebar');
        try {
            const collapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (collapsed) sidebar.classList.add('collapsed');
        } catch (e) {
            // ignore localStorage errors
        }
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
        try {
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        } catch (e) {}
    }
</script>


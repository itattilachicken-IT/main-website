 {{-- Topbar --}}
    <div class="dashboard-topbar">

        <div class="topbar-left">
            <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
                <span class="hamburger-icon">☰</span>
            </button>
            <h2 class="page-title">Account Settings</h2>
        </div>

        <div class="topbar-right">

           
            <div class="user-profile">
                <div class="avatar-initial">
                    {{ strtoupper(substr(session('investor_name', 'I'), 0, 1)) }}
                </div>

                <div class="user-meta">
                    <div class="user-name">
                        {{ session('investor_name', 'Investor') }}
                    </div>

                    <h3 class="id-badge">
                        {{ session('investor_code', '---') }}
                    </h3>
            
                </div>
            </div>

            


        </div>
    </div>
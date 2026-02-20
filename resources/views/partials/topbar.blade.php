 {{-- Topbar --}}
    <div class="dashboard-topbar">

        <div class="topbar-left">
            <h2 class="page-title">Investor's Dashboard</h2>
        </div>

        <div class="topbar-right">

            <div class="search-box">
                <input type="text" placeholder="Search..." />
            </div>
            
            <div class="user-profile">
                <img src="https://i.pravatar.cc/40" alt="User" class="avatar">

                <div class="user-meta">
                    <div class="user-name">John Investor</div>
                    <div class="user-score">Score: 22</div>
                </div>
            </div>

            <div class="search-box">
                <a type="text" href="{{ url('/investors/views/logout') }}" class="btn-secondary">Logout</a>
            </div>


        </div>
    </div>
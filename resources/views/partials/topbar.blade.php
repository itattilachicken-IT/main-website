 {{-- Topbar --}}
    <div class="dashboard-topbar">

        <div class="topbar-left">
            <h2 class="page-title">Dashboard</h2>
        </div>

        <div class="topbar-right">

            <div class="search-box">
                <input type="text" placeholder="Search..." />
            </div>
            
            <div class="user-profile">
                <img src="https://i.pravatar.cc/40" alt="User" class="avatar">

                <div class="user-meta">
                    <div class="user-name">John Investor</div>
            
                </div>
            </div>

            <form action="{{ route('investor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary">Logout</button>
            </form>


        </div>
    </div>
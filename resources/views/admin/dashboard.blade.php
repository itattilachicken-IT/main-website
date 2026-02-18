@extends('layouts.app')

@section('content')
<style>
:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
    --brand-white: #ffffff;
}

/* Sidebar */
#sidebarMenu {
    background-color: var(--brand-black);
    color: var(--brand-white);
    min-height: 100vh;
}

#sidebarMenu .nav-link {
    color: var(--brand-white);
    transition: all 0.2s;
}

#sidebarMenu .nav-link:hover,
#sidebarMenu .nav-link.active {
    background-color: var(--brand-red);
    color: var(--brand-white);
}

#sidebarMenu .collapse .nav-link {
    padding-left: 2rem; /* indent submenu */
}

/* Cards */
.card.bg-red {
    background-color: var(--brand-red);
    color: var(--brand-white);
}
.card.bg-yellow {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
}
.card.bg-black {
    background-color: var(--brand-black);
    color: var(--brand-white);
}
.card.bg-white {
    background-color: var(--brand-white);
    color: var(--brand-black);
}

/* Buttons */
.btn-brand-red {
    background-color: var(--brand-red);
    color: var(--brand-white);
    border: none;
}
.btn-brand-yellow {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
    border: none;
}
.btn-brand-red:hover,
.btn-brand-yellow:hover {
    opacity: 0.85;
}

/* Headings and links */
h1, h2, h3 {
    color: var(--brand-black);
}
a {
    color: var(--brand-red);
}
a:hover {
    color: var(--brand-yellow);
}
</style>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>

                    <!-- Orders -->
                    <li class="nav-item">
                        <a class="nav-link" href="#ordersSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-basket"></i> Orders
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="ordersSubmenu">
                            <li><a class="nav-link" href="{{ route('admin.orders.index') }}">All Orders</a></li>
                            <li><a class="nav-link" href="{{ route('admin.orders.index', ['status' => 'paid']) }}">Paid Orders</a></li>
                            <li><a class="nav-link" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending Orders</a>
                            <li><a class="nav-link" href="{{ route('admin.orders.index', ['status' => 'failed']) }}">Failed Orders</a></li>
                            <!--li><a class="nav-link" href="#">Refunds / Returns</a></li>
                            <li><a class="nav-link" href="#">Abandoned Carts</a></li>-->
                        </ul>
                    </li>

                    <!-- Products -->
                    <li class="nav-item">
                        <a class="nav-link" href="#productsSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-box-seam"></i> Products
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="productsSubmenu">
                            <li><a class="nav-link" href="{{ route('admin.products.index') }}">All Products</a></li>
                            <li><a class="nav-link" href="{{ route('admin.products.create') }}">Add New Product</a></li>
                            <li><a class="nav-link" href="#">Categories</a></li>
                            <li><a class="nav-link" href="#">Variants</a></li>
                            <li><a class="nav-link" href="#">Stock</a></li>
                            <li><a class="nav-link" href="#">Inventory</a></li>
                            <!--li><a class="nav-link" href="#">Bulk Import / Export</a></li>
                            <li><a class="nav-link" href="#">Bulk Import / Export</a></li>-->
                        </ul>
                    </li>

                    <!-- Customers -->
                    <li class="nav-item">
                        <a class="nav-link" href="#customersSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-people"></i> Customers
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="customersSubmenu">
                            <li><a class="nav-link" href="#">All Customers</a></li>
                            <li><a class="nav-link" href="#">Customer Groups</a></li>
                            <li><a class="nav-link" href="#">Loyalty / Rewards</a></li>
                            <li><a class="nav-link" href="#">Customer Notes</a></li>
                        </ul>
                    </li>

                    <!-- Marketing -->
                    <li class="nav-item">
                        <a class="nav-link" href="#marketingSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-megaphone"></i> Marketing
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="marketingSubmenu">
                            <li><a class="nav-link" href="#">Discounts / Coupons</a></li>
                            <li><a class="nav-link" href="#">Promotions / Campaigns</a></li>
                            <li><a class="nav-link" href="#">Email / SMS Marketing</a></li>
                            <li><a class="nav-link" href="#">SEO / Meta Tags</a></li>
                            <li><a class="nav-link" href="#">Banners / Sliders</a></li>
                        </ul>
                    </li>

                    <!-- Shipping -->
                    <li class="nav-item">
                        <a class="nav-link" href="#shippingSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-truck"></i> Shipping
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="shippingSubmenu">
                            <li><a class="nav-link" href="#">Shipping Zones</a></li>
                            <li><a class="nav-link" href="#">Shipping Methods</a></li>
                            <li><a class="nav-link" href="#">Carriers / Tracking</a></li>
                            <li><a class="nav-link" href="#">Warehouses / Fulfillment</a></li>
                        </ul>
                    </li>

                    <!-- Payments -->
                    <li class="nav-item">
                        <a class="nav-link" href="#paymentsSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-credit-card-2-front"></i> Payments
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="paymentsSubmenu">
                            <li><a class="nav-link" href="#">Payment Methods</a></li>
                            <li><a class="nav-link" href="#">Transaction History</a></li>
                            <li><a class="nav-link" href="#">Refunds / Settlements</a></li>
                            <li><a class="nav-link" href="#">Tax Settings</a></li>
                        </ul>
                    </li>

                    <!-- Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="#reportsSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-graph-up"></i> Reports
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="reportsSubmenu">
                            <li><a class="nav-link" href="#">Sales Reports</a></li>
                            <li><a class="nav-link" href="#">Product Performance</a></li>
                            <li><a class="nav-link" href="#">Customer Analytics</a></li>
                            <li><a class="nav-link" href="#">Inventory Reports</a></li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link" href="#settingsSubmenu" data-bs-toggle="collapse">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                        <ul class="collapse list-unstyled ps-3" id="settingsSubmenu">
                            <li><a class="nav-link" href="#">Store Settings</a></li>
                            <li><a class="nav-link" href="#">User Roles / Permissions</a></li>
                            <li><a class="nav-link" href="#">Security / Authentication</a></li>
                            <li><a class="nav-link" href="#">Backups / Export Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="row">
                <!-- Orders -->
                    <div class="col-md-3">
        <div class="card bg-black mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <p class="card-text">{{ \App\Models\Order::count() }}</p>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-brand-red btn-sm">View Orders</a>
            </div>
        </div>
    </div>
                <!-- Paid Orders -->
                <div class="col-md-3">
                    <div class="card bg-red mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Failed Orders</h5>
                            <p class="card-text">{{ \App\Models\Order::where('status','failed')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="col-md-3">
                    <div class="card bg-yellow mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text">{{ \App\Models\Order::where('status','pending')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="col-md-3">
                    <div class="card bg-black mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text">Ksh {{ number_format(\App\Models\Order::where('status','paid')->sum('total_amount'), 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <!-- Total Products -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">{{ \App\Models\Product::count() }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm">View Products</a>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">{{ \App\Models\Order::count() }}</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">View Orders</a>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Orders</h5>
                    <p class="card-text">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">View Pending</a>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">${{ \App\Models\Order::sum('total_amount') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

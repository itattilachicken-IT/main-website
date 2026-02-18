@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Order #{{ $order->id }}</h2>

    <div class="row mb-3">
        <!-- Customer & Payment Info Side by Side -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header py-2">Customer</div>
                <div class="card-body py-2">
                    <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p class="mb-1"><strong>Number:</strong> {{ $order->customer_phone }}</p>
                    <p class="mb-0"><strong>Email:</strong> {{ $order->customer_email }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header py-2">Payment</div>
                <div class="card-body py-2">
                    <p class="mb-1"><strong>Payment #:</strong> {{ $order->payment_phone }}</p>
                    <p class="mb-1"><strong>Total:</strong> Ksh {{ number_format($order->total_amount, 2) }}</p>
                    <p class="mb-0"><strong>Status:</strong>
                        <span class="badge 
                            @if($order->status == 'pending') bg-warning
                            @elseif($order->status == 'completed') bg-success
                            @elseif($order->status == 'canceled') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    @if($order->items && $order->items->count())
    <div class="card shadow-sm mb-3">
        <div class="card-header py-2">Products</div>
        <div class="card-body p-0">
            <table class="table table-sm table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Qty (Kg)</th>
                        <th>Price/Kg</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity_kg }}</td>
    <td>Ksh {{ number_format($item->price_per_kg, 2) }}</td>
    <td>Ksh {{ number_format($item->subtotal, 2) }}</td>
</tr>
@endforeach

                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-start">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">← Back to Orders</a>
    </div>
</div>
@endsection

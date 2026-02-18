@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-success">
        <div class="card-body text-center p-5">
            <h1 class="text-success mb-3">🎉 Payment Received!</h1>
            <p class="lead">Thank you for your order, {{ $order->customer_name }}.</p>

            <div class="mb-4">
                <p><strong>Order Total:</strong> KES {{ number_format($order->total_amount, 0) }}</p>
                <p><strong>Amount Paid:</strong> KES {{ number_format($order->paid_amount, 0) }}</p>
            </div>

            <p class="text-success">Your payment has been successfully received. Your order will be processed shortly.</p>

            <a href="{{ route('shop.index') }}" class="btn btn-outline-success mt-4">Continue Shopping</a>

            {{-- Simulation buttons --}}
            <div class="mt-4 test-buttons">
                <h5>🛠 Testing / Simulation Options:</h5>
                <a href="{{ route('checkout.test_mpesa', $order->id) }}" class="btn btn-info">Test STK Push</a>
                <a href="{{ route('checkout.simulate_mpesa_success', $order->id) }}" class="btn btn-success">Simulate Success</a>
                <a href="{{ route('checkout.simulate_mpesa_fail', $order->id) }}" class="btn btn-danger">Simulate Fail</a>
            </div>
        </div>
    </div>
</div>
@endsection

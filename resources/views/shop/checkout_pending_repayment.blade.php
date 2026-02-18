@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-info">
        <div class="card-body text-center p-5">

            <h1 class="text-info mb-3">ℹ️ Payment Pending Confirmation</h1>
            <p class="lead">Hello {{ $order->customer_name }}, we’ve received your payment attempt for your pending balance.</p>
            <p>Please allow a few minutes for confirmation. Your order will be processed once payment is verified.</p>

            <div class="mb-4">
                <h4>💳 Payment Summary</h4>
                <ul class="list-group list-group-flush mt-3 text-start mx-auto" style="max-width:400px;">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Order Amount:</span>
                        <strong>KES {{ number_format($order->total_amount, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Amount Already Paid:</span>
                        <strong>KES {{ number_format($order->paid_amount, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Pending Balance:</span>
                        <strong>KES {{ number_format(max($order->total_amount - $order->paid_amount, 0), 2) }}</strong>
                    </li>
                </ul>
            </div>

            {{-- Simulation buttons --}}
            <div class="mb-3">
                <h5>🧪 Testing / Simulation Options:</h5>
                <a href="{{ route('checkout.test_mpesa', $order->id) }}" class="btn btn-info mb-2">Test STK Push</a>
                <a href="{{ route('checkout.simulate_mpesa_success', $order->id) }}" class="btn btn-success mb-2">Simulate Success</a>
                <a href="{{ route('checkout.simulate_mpesa_fail', $order->id) }}" class="btn btn-danger mb-2">Simulate Fail</a>
            </div>

            <a href="{{ route('shop.index') }}" class="btn btn-secondary mt-4">Back to Shop</a>
        </div>
    </div>
</div>
@endsection

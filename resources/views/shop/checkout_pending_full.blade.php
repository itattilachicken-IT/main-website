@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-warning">
        <div class="card-body text-center p-5">
            <h1 class="text-warning mb-3">⚠ Payment Pending (Full Amount)</h1>
            <p class="lead">We’re waiting for confirmation of your full payment. This usually takes a few minutes.</p>
            <p>If you paid via <strong>M-Pesa</strong> or <strong>Airtel Money</strong>, please follow the instructions on your phone.</p>

            <div class="mb-4">
                <h4>💰 Payment Summary</h4>
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Order Amount:</span>
                        <strong>KES {{ number_format($order->total_amount, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Amount Paid:</span>
                        <strong>KES {{ number_format($order->paid_amount, 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Remaining Balance:</span>
                        <strong>
                            KES {{ number_format(max($order->total_amount - $order->paid_amount, 0), 2) }}
                        </strong>
                    </li>
                </ul>
            </div>

            {{-- Simulation buttons --}}
            <div class="mb-3">
                <h5>🛠 Testing Options:</h5>
                <a href="{{ route('checkout.test_mpesa', $order->id) }}" class="btn btn-info mb-2">Test STK Push</a>
                <a href="{{ route('checkout.simulate_mpesa_success', $order->id) }}" class="btn btn-success mb-2">Simulate Success</a>
                <a href="{{ route('checkout.simulate_mpesa_fail', $order->id) }}" class="btn btn-danger mb-2">Simulate Fail</a>
            </div>

            <a href="{{ route('shop.index') }}" class="btn btn-outline-warning mt-4">Back to Shop</a>
        </div>
    </div>
</div>
@endsection

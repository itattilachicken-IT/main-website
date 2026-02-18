@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-success">
        <div class="card-body text-center p-5">
            <h1 class="text-success mb-3">🎉 Payment Received!</h1>
            <p class="lead">Thank you for your order, {{ $order->customer_name }}.</p>

            {{-- Payment summary --}}
            <div class="mb-4">
                <p><strong>Total Amount:</strong> KES {{ number_format($order->total_amount, 0) }}</p>
                <p><strong>Amount Paid:</strong> KES {{ number_format($order->paid_amount, 0) }}</p>
                <p><strong>Pending Balance:</strong> KES {{ number_format($order->total_amount - $order->paid_amount, 0) }}</p>
            </div>

            @if($order->total_amount > $order->paid_amount)
                <p class="text-warning">You still have a pending balance. Please complete payment to avoid delays.</p>
                @if($order->guest_token)
                    <a href="{{ route('checkout.payment_guest', $order->guest_token) }}" class="btn btn-warning mb-3">
                        Pay Pending Balance
                    </a>
                @endif
            @else
                <p class="text-success">Your payment is complete. Your order will be processed shortly.</p>
            @endif

            <a href="{{ route('shop.index') }}" class="btn btn-outline-success mt-4">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection

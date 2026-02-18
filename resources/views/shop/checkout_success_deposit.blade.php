@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-info">
        <div class="card-body text-center p-5">
            <h1 class="text-info mb-3">ℹ️ Partial Payment Received</h1>
            
            <p class="lead">Thank you for your payment, <strong>{{ $order->customer_name }}</strong>.</p>

            <div class="mb-4">
                <p><strong>Total Order Amount:</strong> KES {{ number_format($order->total_amount, 0) }}</p>
                <p><strong>Amount Paid:</strong> KES {{ number_format($order->paid_amount, 0) }}</p>
                <p><strong>Pending Balance:</strong> KES {{ number_format($order->total_amount - $order->paid_amount, 0) }}</p>
            </div>

            <p class="text-dark">
                You still have a pending balance of <strong>KES {{ number_format($order->total_amount - $order->paid_amount, 0) }}</strong>.  
                You can complete the remaining payment <strong>before or on delivery</strong> using the link sent to your email.
            </p>

            

            <a href="{{ route('shop.index') }}" class="btn btn-info text-white mt-3">
                Back to Shop
            </a>
        </div>
    </div>
</div>
@endsection

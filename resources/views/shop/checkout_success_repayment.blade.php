@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-info">
        <div class="card-body text-center p-5">
            <h1 class="text-info mb-3">✅ Payment Confirmed</h1>
            
            <p class="lead">
                Thank you, <strong>{{ $order->customer_name }}</strong>. Your final payment has been successfully received and confirmed.
            </p>

            <div class="mb-4 text-start mx-auto" style="max-width:400px;">
                <p><strong>Total Order Amount:</strong> KES {{ number_format($order->total_amount, 0) }}</p>
                <p><strong>Total Paid:</strong> KES {{ number_format($order->paid_amount, 0) }}</p>
                <p><strong>Pending Balance:</strong> <span class="text-success">KES 0</span></p>
            </div>

            <p class="text-success">
                🎉 Your order is now fully paid and confirmed. No further action is required.
            </p>

            <a href="{{ route('shop.index') }}" class="btn btn-info text-white mt-3">Back to Shop</a>
        </div>
    </div>
</div>
@endsection

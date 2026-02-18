@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-danger">
        <div class="card-body text-center p-5">
            <h1 class="text-danger mb-3">❌ Payment Failed</h1>
            <p class="lead">Unfortunately, your payment could not be processed. Please try again or choose another payment method.</p>
            <a href="{{ route('checkout.payment', $order->id ?? 0) }}" class="btn btn-danger mt-4">Try Again</a>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary mt-4">Back to Shop</a>
        </div>
    </div>
</div>
@endsection

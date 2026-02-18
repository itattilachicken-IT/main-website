@extends('layouts.app')

@section('title', 'Payment Failed - Attila Chicken')

@section('content')
<div class="container py-5 text-center">
    <h1 class="text-danger fw-bold mb-3">Payment Failed</h1>
    <p class="mb-3">Unfortunately, your payment could not be processed at this time. Please try again or contact support for assistance.</p>

    <a href="{{ route('checkout.index') }}" class="btn btn-warning me-2">Back to Checkout</a>
    <a href="{{ route('shop.index') }}" class="btn btn-secondary">Back to Shop</a>
</div>
@endsection

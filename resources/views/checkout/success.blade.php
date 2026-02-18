@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-2">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            {{-- Card --}}
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body text-center p-2 p-md-2">

                    {{-- Success Icon --}}
                    <div class="mb-2">
                        <span class="text-success" style="font-size:40px;">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                    </div>

                    {{-- Title --}}
                    <h2 class="fw-bold mb-2">Payment Successful</h2>

                    {{-- Status Message --}}
                    <p class="text-muted mb-2">
                        Thank you, <strong>{{ $order->customer_name }}</strong>! 
                        We’ve received your full payment of 
                        <strong>KSh {{ number_format($order->total_amount, 2) }}</strong>.
                    </p>

                    {{-- Order Summary --}}
                    <div class="bg-light rounded-3 p-2 p-md-2 mb-2 shadow-sm">

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Order #</span>
                            <span class="fw-semibold">#{{ $order->id }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Order Amount</span>
                            <span>KSh {{ number_format($order->total_amount, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-success fw-semibold">Amount Paid</span>
                            <span class="fw-bold text-success">KSh {{ number_format($order->total_amount, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="text-success fw-semibold">Remaining Balance</span>
                            <span class="fw-bold text-success">Fully Paid</span>
                        </div>
                    </div>

                    {{-- Confirmation Note --}}
                    <div class="alert alert-success rounded-3 shadow-sm mb-2 py-2">
                        Your order is fully paid and is now being processed for delivery.
                    </div>

                    {{-- Continue Shopping --}}
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4 rounded-pill mb-2">
                        <i class="bi bi-shop me-2"></i>Continue Shopping
                    </a>

                    {{-- Optional Note --}}
                    <p class="text-muted small mt-2">
                        You will receive updates via email regarding your order delivery.
                    </p>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- No auto-refresh for fully paid orders --}}
@endsection

@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-2">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            {{-- Card --}}
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body text-center p-2 p-md-5">

                    {{-- Success Icon --}}
                    <div class="mb-2">
                        <span class="text-warning" style="font-size:40px;">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                    </div>

                    {{-- Title --}}
                    <h2 class="fw-bold mb-2">Partial Payment Received</h2>

                    {{-- Subtitle --}}
                    <p class="text-muted mb-2">
                        Thank you, <strong>{{ $order->customer_name }}</strong>! 
                        Your partial payment has been received.
                    </p>

                    {{-- Order Summary --}}
                    <div class="bg-light rounded-3 p-3 p-md-4 mb-2 shadow-sm">

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
                            <span class="fw-bold text-success">KSh {{ number_format($order->paid_amount, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <span class="text-danger fw-semibold">Remaining Balance</span>
                            <span class="fw-bold text-danger">KSh {{ number_format($order->balance, 2) }}</span>
                        </div>

                    </div>

                    {{-- Reminder --}}
                    <div class="alert alert-warning rounded-3 shadow-sm mb-2 py-2">
                        Please complete the remaining balance before delivery or collection.
                    </div>

                    {{-- Continue Shopping --}}
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4 rounded-pill">
                        <i class="bi bi-shop me-2"></i>Continue Shopping
                    </a>

                    {{-- Optional note --}}
                    <p class="text-muted small mt-2">
                        We will notify you once your order is ready for delivery.
                    </p>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">

    @php
        $amountToPay = $order->total_amount;
        $phone = $order->payment_phone ?? $order->customer_phone;
        $processingMessage = "Your full payment of KSh " . number_format($amountToPay, 2) . " is being processed on {$phone}...";
    @endphp

    <div id="spinner" class="my-4">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Processing payment...</span>
        </div>

        <p class="mt-2 fw-bold" id="processingMessage">{{ $processingMessage }}</p>
        <p class="text-muted small">Please complete the payment on your phone. This may take a few moments.</p>
    </div>

    <p class="fw-bold" id="orderStatus">Status: Pending</p>

    <div class="mt-3 text-muted small">
        <strong>Order Number:</strong> #{{ $order->id }}<br>
        <strong>Phone:</strong> {{ $phone }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const orderId = @json($order->id);
    const pollInterval = 5000; // 5 sec
    const maxWaitTime = 180000; // 3 min
    const startTime = Date.now();

    let stopped = false;
    let inFlight = false;

    const orderStatusEl = document.getElementById("orderStatus");
    const processingMessageEl = document.getElementById("processingMessage");

    const redirect = (url) => {
        stopped = true;
        setTimeout(() => window.location.href = url, 600);
    };

    const setPaidUI = () => {
        orderStatusEl.textContent = "Status: Paid";
        processingMessageEl.textContent = "Payment confirmed. Finalizing your order...";
    };

    const pollStatus = async () => {
        if (stopped || inFlight) return;
        inFlight = true;

        try {
            const res = await fetch(`/checkout/status/${orderId}`);
            const data = await res.json();

            if (data.status === "success") {
                const state = (data.order_status || "").toLowerCase();

                if (state === "paid") {
                    setPaidUI();
                    redirect("{{ route('checkout.success') }}?order_id=" + orderId);
                    return;
                }

                if (state === "failed" || state === "cancelled") {
                    orderStatusEl.textContent = "Status: Payment Failed / Cancelled";
                    redirect("{{ route('checkout.failed') }}?order_id=" + orderId);
                    return;
                }

                // Still pending
                orderStatusEl.textContent = "Status: Pending (waiting for confirmation)";
            }

            // Timeout handling
            if (Date.now() - startTime >= maxWaitTime) {
                orderStatusEl.textContent = "Status: Timeout";
                redirect("{{ route('checkout.failed') }}?order_id=" + orderId);
                return;
            }

        } catch (err) {
            console.error("Error checking order status:", err);
        }

        inFlight = false;
    };

    // Start polling
    pollStatus();
    const intervalId = setInterval(() => {
        if (stopped) clearInterval(intervalId);
        else pollStatus();
    }, pollInterval);

    // Stop polling on page unload
    window.addEventListener("beforeunload", () => { stopped = true; });

});
</script>
@endsection

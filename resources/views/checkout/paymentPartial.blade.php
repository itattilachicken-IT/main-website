@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">

    @php
        $amountToPay = $amountToPay ?? $order->balance; 
        $phone = $order->payment_phone ?? $order->customer_phone;

        $processingMessage = "Your deposit of KSh " . number_format($amountToPay, 2) . 
            " (including delivery) is being processed on {$phone}...";
    @endphp

    <div id="spinner" class="my-4">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Processing payment...</span>
        </div>

        <p class="mt-2 fw-bold" id="processingMessage">{{ $processingMessage }}</p>
        <p class="text-muted small">
            Please complete the payment on your phone. The remaining balance will be payable later.
        </p>
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
    const pollInterval = 5000;
    const maxWaitTime = 180000;
    const startTime = Date.now();

    let stopped = false;
    let inFlight = false;

    const orderStatusEl = document.getElementById("orderStatus");
    const processingMessageEl = document.getElementById("processingMessage");
    const spinnerEl = document.getElementById("spinner");

    const redirect = (url) => {
        stopped = true;
        setTimeout(() => window.location.href = url, 600);
    };

    const setPaidUI = (partial = false) => {
        if (partial) {
            orderStatusEl.textContent = "Status: Partially Paid";
            processingMessageEl.textContent = "Deposit received. Remaining balance is pending...";
        } else {
            orderStatusEl.textContent = "Status: Fully Paid";
            processingMessageEl.textContent = "Payment confirmed. Finalizing your order...";
        }
    };

    const addRetryUI = () => {
        orderStatusEl.textContent = "Status: Taking longer than expected";

        const note = document.createElement("p");
        note.className = "text-muted mt-2";
        note.textContent = "If you've already paid, your order will still be confirmed shortly.";

        const retryBtn = document.createElement("button");
        retryBtn.className = "btn btn-secondary mt-2";
        retryBtn.textContent = "Retry Checking Payment";

        retryBtn.onclick = () => {
            stopped = false;
            poll();
        };

        spinnerEl.appendChild(note);
        spinnerEl.appendChild(retryBtn);
    };

    const poll = async () => {
        if (stopped || inFlight) return;
        inFlight = true;

        try {
            const res = await fetch(`/checkout/status/${orderId}`);
            const data = await res.json();

            if (data.status === "success") {
                const state = (data.order_status || "").toLowerCase();
                const balance = parseFloat(data.balance ?? 0);

                if (state === "paid" || balance === 0) {
                    setPaidUI(false);
                    redirect("{{ route('checkout.success') }}?order_id=" + orderId);
                    return;
                }

                if (state === "partially_paid" && balance > 0) {
                    setPaidUI(true);
                    // optionally let the user pay remaining balance later
                    redirect("{{ route('checkout.success') }}?order_id=" + orderId);
                    return;
                }

                if (state === "failed" || state === "cancelled") {
                    orderStatusEl.textContent = "Status: Payment Failed / Cancelled";
                    redirect("{{ route('checkout.failed') }}?order_id=" + orderId);
                    return;
                }

                // still pending
                orderStatusEl.textContent = "Status: Pending (waiting for confirmation)";
            }

            // timeout
            if (Date.now() - startTime >= maxWaitTime) {
                stopped = true;
                addRetryUI();
                return;
            }

        } catch (err) {
            console.error("Polling error:", err);
        }

        inFlight = false;
    };

    // Start polling
    poll();
    const intervalId = setInterval(() => {
        if (stopped) clearInterval(intervalId);
        else poll();
    }, pollInterval);

    // stop polling on page unload
    window.addEventListener("beforeunload", () => { stopped = true; });

});
</script>
@endsection

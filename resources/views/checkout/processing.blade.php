@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">

    @php
        $amountToPay = $amountToPay ?? $order->total_amount;
        $phone = $order->payment_phone ?? $order->customer_phone;

        $processingMessageText =
            ($order->payment_type === 'full' || $amountToPay >= $order->total_amount)
            ? "Your full payment of KSh " . number_format($amountToPay, 2) . " is being processed on {$phone}..."
            : "Your deposit of KSh " . number_format($amountToPay, 2) . " is being processed on {$phone}...";

        $stkStatusMessage = '';
        if(isset($stkResponse)) {
            if(($stkResponse->status ?? $stkResponse['status'] ?? null) === 'success'){
                $stkStatusMessage = "✅ STK Push sent to {$phone} for KSh " . number_format($amountToPay, 2);
            } else {
                $stkStatusMessage = "❌ STK Push failed: " . ($stkResponse->message ?? 'Unknown error');
            }
        }
    @endphp

    {{-- Spinner & Messages --}}
    <div id="spinner" class="my-4">
        <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Processing payment...</span>
        </div>

        <p class="mt-3 fw-bold" id="processingMessage">{{ $processingMessageText }}</p>

        @if($stkStatusMessage)
            <p class="text-muted small">{{ $stkStatusMessage }}</p>
        @endif

        <p class="text-muted small">Please complete the payment on your phone. This may take a few moments.</p>
    </div>

    <p class="fw-bold" id="orderStatus">Status: Awaiting M-Pesa confirmation...</p>

    <div class="mt-3 text-muted small">
        <strong>Order Number:</strong> #{{ $order->id }}<br>
        <strong>Phone:</strong> {{ $phone }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const orderId = @json($order->id);
    const pollInterval = 5000; // poll every 5 seconds
    const maxWaitTime = 180000; // 3 minutes max
    const startTime = Date.now();

    let polling = true;
    let inflight = false;

    const processingMessageEl = document.getElementById("processingMessage");
    const orderStatusEl = document.getElementById("orderStatus");
    const spinnerEl = document.getElementById("spinner");

    const redirectToSuccess = (partial = false) => {
        polling = false;
        const route = partial
            ? "{{ route('checkout.success.partial') }}"
            : "{{ route('checkout.success') }}";
        window.location.href = route + "?order_id=" + orderId;
    };

    const redirectToFailed = () => {
        polling = false;
        window.location.href = "{{ route('checkout.failed') }}?order_id=" + orderId;
    };

    const updateUI = (status, balance = 0) => {
        switch(status) {
            case 'paid':
                orderStatusEl.textContent = "Status: Payment Confirmed";
                processingMessageEl.textContent = "Payment successful! Finalizing your order...";
                spinnerEl.style.display = "none";
                break;

            case 'partially_paid':
                orderStatusEl.textContent = `Status: Partial payment received. Remaining KSh ${balance.toFixed(2)}`;
                processingMessageEl.textContent = "Partial payment confirmed. Please complete remaining balance manually.";
                spinnerEl.style.display = "none";
                break;

            case 'failed':
            case 'cancelled':
                orderStatusEl.textContent = "Status: Payment Failed / Cancelled";
                processingMessageEl.textContent = "Your payment could not be completed.";
                spinnerEl.style.display = "none";
                break;

            case 'pending':
            default:
                orderStatusEl.textContent = "Status: Awaiting M-Pesa confirmation...";
                break;
        }
    };

   const showRetry = () => {
    // Remove previous retry messages/buttons if any
    const oldInfo = spinnerEl.querySelector(".retry-info");
    if (oldInfo) oldInfo.remove();

    const info = document.createElement("p");
    info.className = "text-muted mt-2 retry-info";
    info.textContent = "Payment is taking longer than expected. If you've already paid, your order will still be confirmed shortly.";

    const retryBtn = document.createElement("button");
    retryBtn.className = "btn btn-secondary mt-2 retry-info";
    retryBtn.textContent = "Retry Checking Payment";
    retryBtn.onclick = () => {
        polling = true;
        poll();
        // Remove retry message/button when retrying
        info.remove();
        retryBtn.remove();
    };

    spinnerEl.appendChild(info);
    spinnerEl.appendChild(retryBtn);
};

    const poll = async () => {
        if (!polling || inflight) return;
        inflight = true;

        try {
            const res = await fetch(`/checkout/status/${orderId}`);
            const data = await res.json();

            if (data.status === "success") {
                const state = (data.order_status || "").toLowerCase();
                const balance = parseFloat(data.balance ?? 0);

                if (state === "paid") {
                    updateUI('paid');
                    redirectToSuccess();
                    return;
                }

                if (state === "partially_paid" && balance > 0) {
                    updateUI('partially_paid', balance);
                    redirectToSuccess(true);
                    return;
                }

                if (state === "failed" || state === "cancelled") {
                    updateUI('failed');
                    redirectToFailed();
                    return;
                }

                updateUI('pending');
            }

            if (Date.now() - startTime >= maxWaitTime) {
                polling = false;
                showRetry();
            }

        } catch (e) {
            console.error("Polling error:", e);
        }

        inflight = false;
    };

    // Start polling immediately
    poll();
    const interval = setInterval(() => {
        if (!polling) clearInterval(interval);
        poll();
    }, pollInterval);

});
</script>
@endsection

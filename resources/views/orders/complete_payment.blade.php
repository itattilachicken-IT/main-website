@extends('layouts.app')

@section('title', 'Complete Your Payment')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Complete Your Payment</h4>
                </div>

                <div class="card-body text-center">
                    <p class="text-muted">
                        Hi <strong>{{ $order->customer_name }}</strong>, please complete your payment below.
                    </p>

                    @php
                        $orderAmount = $order->total_amount - $order->delivery_fee;
                    @endphp

                    <table class="table table-bordered mt-3">
                        <tbody>
                            <tr>
                                <th>Order ID</th>
                                <td>#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Customer Phone</th>
                                <td>{{ $order->customer_phone }}</td>
                            </tr>
                            <tr>
                                <th>Order Amount</th>
                                <td>KSh {{ number_format($orderAmount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Fee</th>
                                <td>KSh {{ number_format($order->delivery_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Total Amount</th>
                                <td><strong>KSh {{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td><strong class="text-success">KSh {{ number_format($order->paid_amount, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Remaining Balance</th>
                                <td>
                                    <strong class="{{ $remainingBalance > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ $remainingBalance > 0 ? 'KSh ' . number_format($remainingBalance, 2) : 'Fully Paid' }}
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Type</th>
                                <td>{{ ucfirst($order->payment_type) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($remainingBalance > 0)
                        {{-- Alternative Phone Option --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="useAltPhone">
                            <label class="form-check-label" for="useAltPhone">
                                Use a different payment number
                            </label>
                        </div>

                        <div class="mb-3" id="altPhoneDiv" style="display:none;">
                            <input type="text" id="altPhoneInput" class="form-control" placeholder="Enter alternative phone">
                        </div>

                        <button id="payNowBtn" 
                                class="btn btn-success btn-lg px-5"
                                data-token="{{ $token }}"
                                data-amount="{{ $remainingBalance }}">
                            <i class="bi bi-phone"></i> Pay Remaining Balance
                        </button>
                        <p class="text-muted mt-2 mb-0">
                            You’ll receive an M-Pesa STK prompt on your phone to confirm payment.
                        </p>
                    @else
                        <div class="alert alert-success">
                            <strong>✅ Payment Complete!</strong> Thank you for your order.
                        </div>
                    @endif

                    <div id="paymentStatus" class="mt-4"></div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const payBtn = document.getElementById("payNowBtn");
    const statusDiv = document.getElementById("paymentStatus");
    const useAltPhone = document.getElementById("useAltPhone");
    const altPhoneDiv = document.getElementById("altPhoneDiv");

    if (useAltPhone) {
        useAltPhone.addEventListener("change", () => {
            altPhoneDiv.style.display = useAltPhone.checked ? 'block' : 'none';
        });
    }

    if (payBtn) {
        payBtn.addEventListener("click", async () => {
            const token = payBtn.dataset.token;
            const amount = parseFloat(payBtn.dataset.amount);
            const paymentPhone = document.getElementById('altPhoneInput')?.value || null;

            payBtn.disabled = true;
            payBtn.innerHTML = "Processing STK Push...";

            try {
                const res = await fetch(`${window.location.origin}/api/checkout/stkpush`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        token: token,
                        payment_phone: paymentPhone
                    })
                });

                const data = await res.json();

                if (data.status === "success") {
                    statusDiv.innerHTML = `
                        <div class="alert alert-info text-center">
                            <strong>${data.message}</strong><br>
                            Please check your phone to complete the payment.
                        </div>`;
                } else {
                    statusDiv.innerHTML = `
                        <div class="alert alert-danger text-center">
                            <strong>Error:</strong> ${data.message || 'Something went wrong.'}
                        </div>`;
                }
            } catch (err) {
                console.error(err);
                statusDiv.innerHTML = `
                    <div class="alert alert-danger text-center">
                        An unexpected error occurred. Please try again.
                    </div>`;
            } finally {
                payBtn.disabled = false;
                payBtn.innerHTML = '<i class="bi bi-phone"></i> Pay Remaining Balance';
            }
        });
    }
});
</script>
@endsection

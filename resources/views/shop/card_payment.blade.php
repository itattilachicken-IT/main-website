@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pay with Card</h2>

    <div class="card shadow p-4">
        <h4 class="mb-3">Order #{{ $order->id }}</h4>
        <p>Total Amount: <strong>KES {{ number_format($order->paid_amount, 2) }}</strong></p>

        <div id="card-element" class="form-control mb-3"></div>
        <div id="card-errors" class="text-danger mb-3"></div>

        <button id="pay-button" class="btn btn-primary w-100">Pay Now</button>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stripe = Stripe("{{ config('services.stripe.key') }}"); // Publishable key
        const elements = stripe.elements();
        const card = elements.create("card", { hidePostalCode: true });
        card.mount("#card-element");

        const payButton = document.getElementById("pay-button");
        const clientSecret = "{{ $client_secret }}";

        payButton.addEventListener("click", async () => {
            payButton.disabled = true;
            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                }
            });

            if (error) {
                document.getElementById("card-errors").textContent = error.message;
                payButton.disabled = false;
            } else if (paymentIntent && paymentIntent.status === "succeeded") {
                window.location.href = "{{ route('checkout.success', $order->id) }}";
            }
        });
    });
</script>
@endsection

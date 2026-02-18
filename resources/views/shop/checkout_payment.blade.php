@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-body text-center p-5">
            <h1 class="mb-3">💳 Complete Your Payment</h1>
            <p class="lead">Follow the instructions below to complete your payment securely.</p>

            @if(isset($client_secret))
                <div id="card-element" class="mb-3"><!-- Stripe Elements will be inserted here --></div>
                <button id="card-button" class="btn btn-primary">Pay Now</button>
            @else
                <p class="text-muted">No payment client secret found. Please restart checkout.</p>
            @endif
        </div>
    </div>
</div>

@if(isset($client_secret))
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create("card");
    cardElement.mount("#card-element");

    const cardButton = document.getElementById('card-button');
    cardButton.addEventListener('click', async () => {
        const {paymentIntent, error} = await stripe.confirmCardPayment("{{ $client_secret }}", {
            payment_method: { card: cardElement }
        });

        if (error) {
            alert("❌ " + error.message);
        } else if (paymentIntent.status === "succeeded") {
            window.location.href = "{{ route('checkout.success', $order->id) }}";
        }
    });
</script>
@endif
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-3">
    <h1 class="mb-4">Attila Chicken - Full Payment</h1>

    <div class="alert alert-info">
        Your order total is <strong>KSh {{ number_format($totalAmount, 2) }}</strong>.
        STK push will be sent to <strong>{{ $paymentPhone }}</strong>.
    </div>

    <div id="stk-status" class="mt-3">
        <div class="spinner-border text-primary me-2" role="status"></div>
        Waiting for payment confirmation...
    </div>

    <div class="mt-4">
        <a href="{{ route('checkout.index') }}" class="btn btn-secondary me-2">Back to Checkout</a>
        <a href="{{ route('shop.index') }}" class="btn btn-success">Continue Shopping</a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Trigger STK push
    fetch('{{ route('checkout.stkPush') }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
        body: JSON.stringify({
            order_id: '{{ $order->id }}',
            payment_phone: '{{ $paymentPhone }}',
            amount: '{{ $totalAmount }}'
        })
    })
    .then(res => res.json())
    .then(data => console.log('STK Push Response:', data))
    .catch(err => console.error(err));

    // Poll payment status every 5 seconds
    const interval = setInterval(async () => {
        const res = await fetch('{{ route("checkout.status", ["order" => $order->id]) }}');
        const data = await res.json();

        if (data.status === 'paid') {
            document.getElementById('stk-status').innerHTML = '<div class="alert alert-success">Payment confirmed! Redirecting...</div>';
            clearInterval(interval);
            window.location.href = '{{ route("checkout.success") }}';
        } else if (data.status === 'failed') {
            document.getElementById('stk-status').innerHTML = '<div class="alert alert-danger">Payment failed. Try again or contact support.</div>';
            clearInterval(interval);
        }
    }, 5000);
});
</script>
@endsection

Your order #{{ $order->id }} has a pending balance.

Pending amount: KES {{ number_format($pendingAmount, 2) }}

@isset($paymentLink)
You can complete your payment here: {{ $paymentLink }}
@endisset

Thank you for shopping with us!

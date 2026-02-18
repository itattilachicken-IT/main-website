@component('mail::message')
# Complete Your Pending Payment

Hello {{ $order->customer_name }},

Thank you for your order **#{{ $order->id }}**. We really appreciate your prompt payment of **KES {{ number_format($order->paid_amount, 2) }}**.  

You still have a pending balance of **KES {{ number_format($pendingAmount, 2) }}**, which you can pay **on or before delivery** at your convenience.

@component('mail::button', ['url' => $paymentLink])
Complete Payment
@endcomponent

**Order Summary:**  
- **Total Amount:** KES {{ number_format($order->total_amount, 2) }}  
- **Amount Paid:** KES {{ number_format($order->paid_amount, 2) }}  
- **Pending Balance:** KES {{ number_format($pendingAmount, 2) }}

We appreciate your business and look forward to delivering your order soon.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

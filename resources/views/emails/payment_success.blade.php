@component('mail::message')
# Payment Received ✅

Hello {{ $order->customer_name }},

We have successfully received your full payment of **KES {{ number_format($order->paid_amount, 0) }}** for your order **#{{ $order->id }}**. Thank you for your prompt payment!  

Your order is now fully paid and will be processed for delivery immediately.  

**Order Summary:**  
- **Total Amount:** KES {{ number_format($order->total_amount, 0) }}  
- **Amount Paid:** KES {{ number_format($order->paid_amount, 0) }}  

We appreciate your business and look forward to delivering your order soon.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

   
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

   
    public function build()
{
    return $this->subject('Complete Your Pending Payment')
        ->markdown('emails.pending_payment')
        ->with([
            'order' => $this->order,
            'pendingAmount' => $this->order->total_amount - $this->order->paid_amount,
            'paymentLink' => route('checkout.payment_guest', $this->order->guest_token),
        ]);
}

}

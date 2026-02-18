<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

   
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    
    public function build()
    {
        return $this->subject('Payment Received for Your Order')
                    ->markdown('emails.payment_success')
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFullPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $order;

    
    public function __construct($order)
    {
        $this->order = $order;
    }

    
    public function build()
    {
        return $this->from('orders@attilachicken.com', 'Attila Chicken')
                    ->subject('Order Confirmed - Attila Chicken')
                    ->view('emails.order_full_payment')
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}

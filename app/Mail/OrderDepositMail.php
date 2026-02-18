<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDepositMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $paymentLink;

    
    public function __construct($order, $paymentLink)
    {
        $this->order = $order;
        $this->paymentLink = $paymentLink;
    }

    
    public function build()
    {
        $subject = sprintf(
            'Deposit Received - Order #%s (KSh %s)',
            $this->order->id,
            number_format($this->order->paid_amount, 2)
        );

        
        $messageId = sprintf('<order-%s-%s@attilachicken.com>', $this->order->id, uniqid());

        return $this->from('orders@attilachicken.com', 'Attila Chicken')
                    ->subject($subject)
                    ->view('emails.order_deposit')
                    ->with([
                        'order' => $this->order,
                        'paymentLink' => $this->paymentLink, 
                    ])
                    ->withSwiftMessage(function ($message) use ($messageId) {
                        $message->getHeaders()->addTextHeader('Message-ID', $messageId);
                    });
    }
}

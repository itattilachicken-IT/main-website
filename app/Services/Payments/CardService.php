<?php

namespace App\Services\Payments;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class CardService
{
    public function __construct()
    {
        // Load Stripe secret key from config/services.php
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a PaymentIntent and return the client secret
     *
     * @param \App\Models\Order $order
     * @return string
     */
   public function pay($order)
{
    $paymentIntent = PaymentIntent::create([
        'amount' => intval($order->paid_amount * 100), // in cents
        'currency' => 'usd', // ⚠️ only works if Stripe supports KES for your account
        'metadata' => [
            'order_id' => $order->id,
            'customer_name' => $order->customer_name,
        ],
    ]);

    return $paymentIntent->client_secret; // ✅ Pass this to Blade
}


}
 
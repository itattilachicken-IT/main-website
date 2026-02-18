<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Http;

class PesapalService
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->consumerKey = env('PESAPAL_CONSUMER_KEY');
        $this->consumerSecret = env('PESAPAL_CONSUMER_SECRET');
        $this->baseUrl = env('PESAPAL_ENV', 'sandbox') === 'live'
            ? 'https://pay.pesapal.com/v3'
            : 'https://cybqa.pesapal.com/pesapalv3';
    }

    /** Get OAuth token */
    protected function getToken()
    {
        $response = Http::post("{$this->baseUrl}/api/Auth/RequestToken", [
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerSecret,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to authenticate with Pesapal.');
        }

        return $response->json()['token'] ?? null;
    }

    /** Initiate a payment request */
    public function pay($order)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)->post("{$this->baseUrl}/api/Transactions/SubmitOrderRequest", [
            'id' => $order->id,
            'currency' => 'KES',
            'amount' => $order->paid_amount,
            'description' => 'Order Payment',
            'callback_url' => route('pesapal.callback'),
            'notification_id' => config('services.pesapal.ipn_id'),
            'billing_address' => [
                'email_address' => 'test@example.com',
                'phone_number' => $order->customer_phone,
                'country_code' => 'KE',
                'first_name' => $order->customer_name,
                'last_name' => '',
            ],
        ]);

        if ($response->failed()) {
            throw new \Exception('Pesapal order request failed.');
        }

        return $response->json();
        \Log::info('Pesapal Response: ', $response);

    }

    /** ✅ Query transaction status */
    public function getTransactionStatus(string $trackingId)
    {
        $token = $this->getToken();

        $response = Http::withToken($token)->get("{$this->baseUrl}/api/Transactions/GetTransactionStatus", [
            'orderTrackingId' => $trackingId,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch transaction status.');
        }

        return $response->json();
    }
}

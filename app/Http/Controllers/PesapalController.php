<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PesapalService
{
    protected Client $client;
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $iframeUrl;   
    protected string $queryUrl;    
    protected string $callbackUrl;
    protected bool $sandbox;

    public function __construct()
    {
        $this->consumerKey = config('services.pesapal.consumer_key');
        $this->consumerSecret = config('services.pesapal.consumer_secret');
        $this->iframeUrl = config('services.pesapal.iframe_url'); 
        $this->queryUrl = config('services.pesapal.query_url'); 
        $this->callbackUrl = config('services.pesapal.callback_url');

        // Detect sandbox mode
        $this->sandbox = str_contains($this->iframeUrl, 'demo.pesapal.com');

        $this->client = new Client();
    }

    
    public function createPayment($order, string $paymentMethod): string
    {
        $data = [
            'amount' => $order->paid_amount,
            'currency' => 'KES',
            'description' => 'Order #' . $order->id,
            'email' => $order->customer_email ?? 'customer@example.com',
            'phonenumber' => $order->customer_phone,
            'reference' => $order->id,
            'payment_method' => $paymentMethod,
            'callback_url' => $this->callbackUrl,
        ];

        try {
            $response = $this->client->post($this->iframeUrl, [
                'form_params' => $data,
                'auth' => [$this->consumerKey, $this->consumerSecret],
                'verify' => $this->sandbox ? false : true,
            ]);

            return trim($response->getBody()->getContents());

        } catch (\Exception $e) {
            Log::error('Pesapal createPayment error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function verifyPayment(string $reference): array
    {
        try {
            $response = $this->client->get($this->queryUrl, [
                'query' => ['reference' => $reference],
                'auth' => [$this->consumerKey, $this->consumerSecret],
                'verify' => $this->sandbox ? false : true,
            ]);

            return json_decode($response->getBody()->getContents(), true) ?? [];

        } catch (\Exception $e) {
            Log::error('Pesapal verifyPayment error: ' . $e->getMessage());
            throw $e;
        }
    }
}

<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PesapalService
{
    protected Client $client;
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $baseUrl;
    protected string $queryUrl;
    protected string $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = trim(config('services.pesapal.consumer_key'));
        $this->consumerSecret = trim(config('services.pesapal.consumer_secret'));
        $this->baseUrl = trim(config('services.pesapal.base_url'));
        $this->queryUrl = trim(config('services.pesapal.query_url'));
        $this->callbackUrl = trim(config('services.pesapal.callback_url'));

        $this->client = new Client();
    }

    public function createPayment($order, string $paymentMethod)
    {
        $data = [
            'amount' => $order->paid_amount,
            'currency' => 'KES',
            'description' => trim('Order #' . $order->id),
            'email' => trim($order->customer_email ?? 'customer@example.com'),
            'phonenumber' => trim($order->customer_phone),
            'reference' => trim($order->id),
            'payment_method' => trim($paymentMethod),
            'callback_url' => $this->callbackUrl,
        ];

        try {
            $response = $this->client->post($this->baseUrl, [
                'form_params' => $data,
                'auth' => [$this->consumerKey, $this->consumerSecret],
                'verify' => true, // always enforce SSL
            ]);

            return trim($response->getBody()->getContents());

        } catch (\Exception $e) {
            Log::error('Pesapal createPayment error: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'payment_method' => $paymentMethod,
            ]);
            throw $e;
        }
    }

    public function verifyPayment(string $reference): array
    {
        try {
            $response = $this->client->get($this->queryUrl, [
                'query' => ['reference' => $reference],
                'auth' => [$this->consumerKey, $this->consumerSecret],
                'verify' => true, // always enforce SSL
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            Log::error('Pesapal verifyPayment error: ' . $e->getMessage(), [
                'reference' => $reference,
            ]);
            throw $e;
        }
    }
}

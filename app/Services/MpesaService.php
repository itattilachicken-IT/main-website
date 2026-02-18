<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MpesaService
{
    protected Client $client;
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $shortCode;
    protected string $passkey;
    protected string $callbackUrl;
    protected string $baseUrl;

    public function __construct()
    {
        $this->consumerKey = config('services.mpesa.consumer_key');
        $this->consumerSecret = config('services.mpesa.consumer_secret');
        $this->shortCode = config('services.mpesa.shortcode');
        $this->passkey = config('services.mpesa.passkey');
        $this->callbackUrl = config('services.mpesa.callback_url');

        $this->baseUrl = config('services.mpesa.env') === 'live'
            ? 'https://api.safaricom.co.ke'
            : 'https://sandbox.safaricom.co.ke';

        $this->client = new Client();
    }

    public function generateToken(): string
    {
        $url = $this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials';
        $response = $this->client->get($url, [
            'auth' => [$this->consumerKey, $this->consumerSecret],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['access_token'] ?? '';
    }

    public function stkPush(string $phone, float $amount, string $accountRef, string $desc)
    {
        $token = $this->generateToken();
        $timestamp = now()->format('YmdHis');
        $password = base64_encode($this->shortCode . $this->passkey . $timestamp);

        $payload = [
            "BusinessShortCode" => $this->shortCode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $this->shortCode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $this->callbackUrl,
            "AccountReference" => $accountRef,
            "TransactionDesc" => $desc,
        ];

        try {
            $response = $this->client->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
                'json' => $payload,
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            Log::error('M-Pesa STK Push error: ' . $e->getMessage(), compact('phone', 'amount'));
            throw $e;
        }
    }

    public function handleCallback(array $data)
    {
        Log::info('M-Pesa Callback received', $data);
        // Update order status based on $data['Body']['stkCallback']['ResultCode']
    }
}

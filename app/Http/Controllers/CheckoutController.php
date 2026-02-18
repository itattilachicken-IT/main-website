<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MpesaService;
use App\Models\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderFullPaymentMail;
use App\Mail\OrderDepositMail;





class CheckoutController extends Controller
{
    /* =====================================================
     * CHECKOUT PAGE
     * ===================================================== */
    public function index()
{
    $routes = Route::all(); 

    return view('checkout.index', compact('routes'));
}

    /* =====================================================
     * PLACE ORDER + INITIATE STK PUSH
     * ===================================================== */
public function placeOrder(Request $request)
{
    try {
        \Log::info('placeOrder started', ['request' => $request->all()]);

        // ---------------------------
        // 1️⃣ Validate request
        // ---------------------------
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'phone'           => ['required', 'regex:/^(\+2547\d{8}|07\d{8}|01\d{8}|2547\d{8})$/'],
            'payment_option'  => 'required|in:full,deposit',
            'cart'            => 'required|array|min:1',
            'cart.*.product_id' => 'required|integer|exists:products,id',
            'cart.*.quantity'   => 'required|integer|min:1',
            'cart.*.price'      => 'required|numeric|min:0',
        ]);

        // ---------------------------
        // 2️⃣ Calculate totals
        // ---------------------------
        $cart = array_values($request->cart);

        $subtotal = array_sum(array_map(
            fn ($i) => $i['price'] * $i['quantity'],
            $cart
        ));

        $deliveryFee = 0;
        $totalAmount = $subtotal + $deliveryFee;
        $depositAmount = round(($subtotal * 0.3) + $deliveryFee, 2);

        $paymentPhone = $request->payment_phone ?? $request->phone;

        $paidAmount = $request->payment_option === 'full' ? $totalAmount : 0;
        $balance = $request->payment_option === 'full' ? 0 : $totalAmount;

        // ---------------------------
        // 3️⃣ Create order
        // ---------------------------
        $order = Order::create([
            'customer_name'   => $request->name,
            'customer_email'  => $request->email,
            'customer_phone'  => $request->phone,
            'payment_phone'   => $paymentPhone,
            'payment_type'    => $request->payment_option,
            'total_amount'    => $totalAmount,
            'paid_amount'     => $paidAmount,
            'balance'         => $balance,
            'delivery_fee'    => $deliveryFee,
            'status'          => 'pending',
            'payment_method'  => 'mpesa',
            'payment_gateway' => 'mpesa',
            'payment_token'   => Str::random(40),
        ]);

        \Log::info('Order created', ['order_id' => $order->id, 'total' => $totalAmount, 'balance' => $balance]);

        // ---------------------------
        // 4️⃣ Insert order items
        // ---------------------------
        foreach ($cart as $item) {
            $order->items()->create([
                'product_id'   => $item['product_id'],
                'quantity_kg'  => $item['quantity'],
                'price_per_kg' => $item['price'],
                'subtotal'     => $item['quantity'] * $item['price'],
            ]);
        }

        // ---------------------------
        // 5️⃣ Trigger STK Push
        // ---------------------------
        $amountToPush = $request->payment_option === 'full' ? $totalAmount : $depositAmount;
        $stkResponse = $this->triggerStkPush($order->id, $paymentPhone, $amountToPush);

        \Log::info('STK push attempted', ['order_id' => $order->id, 'response' => $stkResponse]);

        // ---------------------------
        // 6️⃣ Clear cart and redirect
        // ---------------------------
        session()->forget('cart');
        session(['current_order_id' => $order->id]);

        return redirect()->route('checkout.processing', [
            'order' => $order->id,
            'token' => $order->payment_token
        ]);

    } catch (\Throwable $e) {
        \Log::error('placeOrder failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('error', 'Unable to place order. Please try again.');
    }
}


protected function triggerStkPush(int $orderId, string $phone, float $amount): array
{
    try {
        $order = Order::find($orderId);
        if (!$order) return ['status' => 'error', 'message' => 'Order not found'];

        // ---------------------------
        // Normalize phone
        // ---------------------------
        $phone = preg_replace('/\D/', '', $phone);
        if (str_starts_with($phone, '0')) $phone = '254' . substr($phone, 1);
        if (str_starts_with($phone, '7')) $phone = '254' . $phone;

        // ---------------------------
        // Load config
        // ---------------------------
        $mpesa  = config('services.mpesa');
        $env    = $mpesa['env'];
        $config = $mpesa[$env];

        $consumerKey    = $config['consumer_key'];
        $consumerSecret = $config['consumer_secret'];
        $passkey        = $config['passkey'];
        $baseUrl        = $config['base_url'];
        $callbackUrl    = $mpesa['callback_url'];

        // 🔴 SAFARICOM RULE
        $businessShortCode = $config['shortcode']; // Go-Live shortcode
        $partyB            = $env === 'sandbox'
            ? $config['shortcode']
            : $config['till']; // Till in production

        // ---------------------------
        // OAuth Token
        // ---------------------------
        $token = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->get($baseUrl . '/oauth/v1/generate?grant_type=client_credentials')
            ->throw()
            ->json()['access_token'];

        // ---------------------------
        // STK Payload
        // ---------------------------
        $timestamp = now()->format('YmdHis');
        $password  = base64_encode($businessShortCode . $passkey . $timestamp);

        $payload = [
            'BusinessShortCode' => $businessShortCode,
            'Password'          => $password,
            'Timestamp'         => $timestamp,
            'TransactionType'   => 'CustomerBuyGoodsOnline',
            'Amount'            => (int) round($amount),
            'PartyA'            => $phone,
            'PartyB'            => $partyB,
            'PhoneNumber'       => $phone,
            'CallBackURL'       => $callbackUrl,
            'AccountReference'  => 'ORDER-' . $orderId,
            'TransactionDesc'   => 'Attila Chicken Payment',
        ];

        // ---------------------------
        // Fire STK Push
        // ---------------------------
        $response = Http::withToken($token)
            ->post($baseUrl . '/mpesa/stkpush/v1/processrequest', $payload)
            ->throw()
            ->json();

        $order->update([
            'mpesa_checkout_id' => $response['CheckoutRequestID'],
            'status' => 'processing',
        ]);

        return ['status' => 'success', 'checkout_id' => $response['CheckoutRequestID']];

    } catch (\Throwable $e) {
        \Log::error('STK Push failed', ['error' => $e->getMessage()]);
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

    /* =====================================================
     * PROCESSING PAGE
     * ===================================================== */
    public function processing(Order $order, $token)
{
    abort_unless($order->payment_token === $token, 403);

    // Determine amount to pay
    if ($order->payment_type === 'deposit') {
        // 30% deposit + delivery fee
        $orderSubtotal = $order->total_amount - $order->delivery_fee;
        $amountToPay = round(($orderSubtotal * 0.3) + $order->delivery_fee, 2);
    } else {
        $amountToPay = $order->total_amount;
    }

    return view('checkout.processing', [
        'order' => $order,
        'amountToPay' => $amountToPay,
    ]);
}


    /* =====================================================
     * POLLING STATUS ENDPOINT
     * ===================================================== */
    public function checkStatus(Order $order)
    {
        return response()->json([
            'status'        => 'success',
            'order_status'  => $order->status,
            'balance'       => max($order->total_amount - $order->amount_paid, 0),
        ]);
    }

    /* =====================================================
     * RETRY PAYMENT / BALANCE PAYMENT
     * ===================================================== */
    public function showPayment(Order $order, $token, MpesaService $mpesa)
    {
        abort_unless($order->payment_token === $token, 403);

        if ($order->status === 'paid') {
            return redirect()->route('checkout.success', ['order_id' => $order->id]);
        }

        $balance = $order->total_amount - $order->amount_paid;

        if ($balance <= 0) {
            return redirect()->route('checkout.success');
        }

        // Send STK for remaining balance
        $stk = $mpesa->stkPush(
            phone: $order->payment_phone,
            amount: $balance,
            reference: "Order #{$order->id}",
            description: 'Balance Payment'
        );

        if ($stk['status'] === 'success') {
            $order->update([
                'stk_checkout_id' => $stk['checkout_id'],
                'stk_sent_at'     => now(),
            ]);
        }

        return redirect()->route('checkout.processing', [
            'order' => $order->id,
            'token' => $order->payment_token,
        ]);
    }



    /* =====================================================
     * MPESA CALLBACK
     * ===================================================== */
    public function stkCallback(Request $request)
{
    $data = $request->all();
    \Log::info('STK Callback Received', $data);

    $checkoutId = $data['Body']['stkCallback']['CheckoutRequestID'] ?? null;
    $resultCode = $data['Body']['stkCallback']['ResultCode'] ?? null;

    if (!$checkoutId) {
        return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Missing CheckoutRequestID']);
    }

    $order = Order::where('mpesa_checkout_id', $checkoutId)->first();
    if (!$order) {
        \Log::error('STK Callback: Order not found', ['checkoutId' => $checkoutId]);
        return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Order not found']);
    }

    switch ($resultCode) {
        case 0: // Successful payment
            $callbackItems = $data['Body']['stkCallback']['CallbackMetadata']['Item'] ?? [];
            $amount = 0;
            foreach ($callbackItems as $item) {
                if (($item['Name'] ?? '') === 'Amount') {
                    $amount = (float) $item['Value'];
                    break;
                }
            }

            // Avoid double-counting
            if ($order->status === 'paid') {
                \Log::info("Order {$order->id} already paid. Ignoring callback.");
                return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Already paid']);
            }

            // Update paid amount & balance
            if ($order->payment_type === 'deposit') {
                $order->paid_amount += $amount;
                $order->balance = max(0, $order->total_amount - $order->paid_amount);
                $order->status = $order->balance > 0 ? 'partially_paid' : 'paid';
            } else {
                $order->paid_amount = $order->total_amount;
                $order->balance = 0;
                $order->status = 'paid';
            }

            $order->save();

            \Log::info("Order {$order->id} updated after payment", [
                'paid_amount' => $order->paid_amount,
                'balance' => $order->balance,
                'status' => $order->status,
            ]);

            // -----------------------------
            // 2️⃣ Send email acknowledgement
            // -----------------------------
            if ($order->customer_email) {
                if ($order->status === 'partially_paid') {
                    // Partial payment email
                    $paymentLink = route('checkout.payment.show', [
                        'order' => $order->id,
                        'token' => $order->payment_token
                    ]);

                    Mail::to($order->customer_email)
                        ->send(new \App\Mail\OrderDepositMail($order, $paymentLink));
                } else {
                    // Full payment email
                    Mail::to($order->customer_email)
                        ->send(new \App\Mail\OrderFullPaymentMail($order));
                }
            }

            break;

        case 1037: // Timeout / No response
            $order->status = 'pending';
            $order->save();
            \Log::info("Order {$order->id} remains pending (timeout)");
            break;

        default: // Failed
            $order->status = 'failed';
            $order->save();
            \Log::info("Order {$order->id} failed (code: {$resultCode})");
            break;
    }

    return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback processed successfully']);
}


    /* =====================================================
     * RESULT PAGES
     * ===================================================== */
    public function success(Request $request)
{
    $orderId = session('current_order_id') ?? $request->query('order_id');

    $order = DB::table('orders')->where('id', $orderId)->first();

    if (!$order) {
        return redirect()->route('checkout.index')->with('error', 'Order not found.');
    }

    return view('checkout.success', compact('order'));
}

   public function partialSuccess(Request $request)
{
    $orderId = $request->query('order_id'); // or however you get the order
    $order = Order::findOrFail($orderId); // or DB::table('orders')->where('id', $orderId)->first();

    return view('checkout.success-partial', [
        'order' => $order
    ]);
}


    public function failed()
    {
        return view('checkout.failed');
    }
}

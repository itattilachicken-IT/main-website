<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MpesaCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();
        \Log::info('M-PESA Callback: ', $data);

        $callback = $data['Body']['stkCallback'] ?? null;
        if (!$callback) {
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'No callback data']);
        }

        $checkoutID = $callback['CheckoutRequestID'] ?? null;
        $resultCode = $callback['ResultCode'] ?? 1;

        $order = Order::where('mpesa_checkout_id', $checkoutID)->first();

        if (!$order) {
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Order not found']);
        }

        if ($resultCode == 0) {
            $order->update([
                'status' => 'paid'
            ]);
        } else {
            $order->update([
                'status' => 'failed'
            ]);
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }
}

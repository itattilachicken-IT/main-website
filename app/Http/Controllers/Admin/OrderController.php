<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;



class OrderController extends Controller
{

public function index(Request $request)
{
    $query = Order::query();

    // Filter by status if provided (e.g. pending)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $orders = $query->latest()->paginate(15);

    // Preserve query string for pagination links
    $orders->appends($request->query());

    $orders->getCollection()->transform(function ($order) {
        // Treat the DB timestamp as literal UTC, then add 3 hours for Nairobi
        $order->created_at_nairobi = Carbon::parse($order->created_at)->addHours(3);
        return $order;
    });

    return view('admin.orders.index', compact('orders'));
}




    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        
        $request->validate([
            'status' => 'required|string'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}

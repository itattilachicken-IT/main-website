<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    
public function add(Request $request, Product $product)
{
    $cart  = Session::get('cart', []);
    $force = $request->input('force', false);

    
    $request->validate([
        'variants'   => 'nullable|array',
        'variants.*' => 'integer|exists:product_variants,id',
    ]);

    $variantIds = $request->input('variants', []);
    if (!is_array($variantIds)) {
        $variantIds = [];
    }

    $messages = [];

    
    if ($product->variants()->exists()) {
        if (empty($variantIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Please select at least one variant before adding to cart.'
            ]);
        }

        foreach ($variantIds as $variantId) {
            $variant = $product->variants()->find($variantId);
            if (!$variant) {
                continue;
            }

            $key = $product->id . '_' . $variant->id;

            if (isset($cart[$key])) {
                if ($force) {
                    $cart[$key]['quantity'] += 1;
                    $messages[] = "{$product->name} ({$variant->weight}kg) quantity updated!";
                } else {
                    $messages[] = "{$product->name} ({$variant->weight}kg) is already in your cart!";
                }
            } else {
                $cart[$key] = [
                    'product_id' => $product->id,
                    'variant_id' => $variant->id,
                    'name'       => $product->name,
                    'variant'    => $variant->weight . 'kg',
                    'price'      => $variant->price,
                    'quantity'   => 1,
                    'image'      => $product->image_url,
                ];
                $messages[] = "{$product->name} ({$variant->weight}kg) added to cart!";
            }
        }
    }
   
    else {
        $key = $product->id;

        if (isset($cart[$key])) {
            if ($force) {
                $cart[$key]['quantity'] += 1;
                $messages[] = "{$product->name} quantity updated!";
            } else {
                $messages[] = "{$product->name} is already in your cart!";
            }
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price_per_kg,
                'quantity'   => 1,
                'image'      => $product->image_url,
            ];
            $messages[] = "{$product->name} added to cart!";
        }
    }

    Session::put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => implode("\n", $messages),
        'cart'    => $cart,
    ]);
}

    
    public function updateQuantity(Request $request, $key)
    {
        $cart = session('cart', []);
        $action = $request->input('action');

        if (!isset($cart[$key])) {
            return response()->json(['success' => false, 'message' => 'Item not in cart!']);
        }

        if ($action === 'increase') {
            $cart[$key]['quantity'] += 1;
        } elseif ($action === 'decrease' && $cart[$key]['quantity'] > 1) {
            $cart[$key]['quantity'] -= 1;
        }

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'message' => 'Quantity updated!'
        ]);
    }

   
    public function remove($key)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            Session::put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart'    => $cart,
        ]);
    }
    
    public function clear()
{
    Session::forget('cart');
    GuestCart::where('session_id', session()->getId())->delete();

    return response()->json(['success' => true]);
}

    
}

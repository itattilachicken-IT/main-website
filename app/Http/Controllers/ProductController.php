<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();
        return view('products.index', compact('products'));
    }

    public function show(string $id)
    {
        $product = Product::with('variants')->findOrFail($id);
        return view('products.show', compact('product'));
    }

        public function variants(Product $product)
{
    $variants = $product->variants()->select('id', 'weight', 'price')->get();

    return response()->json([
        'success' => true,
        'variants' => $variants ?? [] 
    ]);
}

}

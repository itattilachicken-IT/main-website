<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Route;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index()
{
    // Eager load variants and paginate 12 per page
    $products = Product::with('variants')->paginate(12);

    // Routes if you need them
    $routes = Route::all();

    return view('shops.index', compact('products', 'routes'));
}


    
    public function show($slug)
    {
        $product = Product::with('variants')->where('slug', $slug)->firstOrFail();
        return view('shops.show', compact('product'));
    }
    
   
    public function search(Request $request)
    {
        $query = $request->input('q');

        $results = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('shops.search', compact('results', 'query'));
    }
}


    

<?php
namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::all();
        return view('home', compact('featuredProducts'));
    }
}

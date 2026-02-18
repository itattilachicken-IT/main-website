<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display all products
    public function index(Request $request)
{
    $products = Product::when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    return view('admin.products.index', compact('products'));
}


    // Show create product form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'description', 'price_per_kg');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store image in public_html/product-images
            $file->move(public_path('product-images'), $filename);

            $data['image'] = 'product-images/' . $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product added successfully!');
    }

    // Show edit form for a product
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update basic fields
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price_per_kg = $request->price_per_kg;

        // If a new image is uploaded, overwrite the old one
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('product-images'), $filename);

            $product->image = 'product-images/' . $filename;
        }

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }

    // Show a single product
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Delete a product and its image
    public function destroy(Product $product)
    {
        // Delete image from disk if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}

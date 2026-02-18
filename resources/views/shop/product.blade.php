{{-- resources/views/shop/product.blade.php --}}
@extends('layouts.app')
@section('content')
<h2>{{ $product->name }}</h2>
<img src="{{ $product->image }}" class="img-fluid mb-3">
<p>{{ $product->description }}</p>
<p>KES {{ number_format($product->price_per_kg,2) }} per kg</p>

<form action="{{ route('shop.cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="mb-3">
        <label>Quantity (kg)</label>
        <input type="number" name="quantity_kg" class="form-control" value="1" min="1">
    </div>
    <button class="btn btn-success">Add to Cart</button>
</form>
@endsection

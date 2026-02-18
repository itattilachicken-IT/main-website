@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image_url }}" 
                 class="img-fluid rounded shadow" 
                 alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <p class="fw-bold">Ksh {{ number_format($product->price_per_kg, 2) }} / Kg</p>

            <form action="{{ route('shop.cart.add') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group">
                    <input type="number" name="quantity" class="form-control" min="1" value="1">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>

            <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mt-3">Back to Shop</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Attila ' . $product->name . ' - Attila Chicken')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="img-fluid rounded shadow-sm"
                     alt="Attila {{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/600x400?text=No+Image"
                     class="img-fluid rounded shadow-sm"
                     alt="Attila {{ $product->name }}">
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h1 class="fw-bold">Attila {{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>
            <p class="fs-5"><strong>Base Price per Kg:</strong> KES {{ number_format($product->price_per_kg, 2) }}</p>

            <!-- Order Now Button (redirect only) -->
            <a href="{{ url('/#contact') }}" class="btn btn-success mt-3">
                🛒 Order Now
            </a>
        </div>
    </div>

    <hr class="my-5">

    <!-- Variants Section -->
    <h3 class="mb-3">Available Variants</h3>
    @if($product->variants->count())
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Weight (kg)</th>
                    <th>Price (KES)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->variants as $variant)
                    <tr>
                        <td>{{ $variant->weight }}</td>
                        <td>KES {{ number_format($variant->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No variants available for this product.</p>
    @endif

    <!-- Back Button -->
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-4">
        ← Back to Products
    </a>
</div>
@endsection

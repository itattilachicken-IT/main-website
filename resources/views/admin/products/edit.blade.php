@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 products-title">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Product Name</label>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       value="{{ old('name', $product->name) }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="price_per_kg" class="form-label">Price per kg (Ksh)</label>
                <input type="number"
                       step="0.01"
                       class="form-control @error('price_per_kg') is-invalid @enderror"
                       id="price_per_kg"
                       name="price_per_kg"
                       value="{{ old('price_per_kg', $product->price_per_kg) }}"
                       required>
                @error('price_per_kg')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description"
                          name="description"
                          rows="4">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="stock" class="form-label">Stock (1 = In Stock, 0 = Out of Stock)</label>
                <input type="number"
                       class="form-control @error('stock') is-invalid @enderror"
                       id="stock"
                       name="stock"
                       min="0"
                       max="1"
                       value="{{ old('stock', $product->stock) }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="image" class="form-label">Product Image</label>
                <input type="file"
                       class="form-control @error('image') is-invalid @enderror"
                       id="image"
                       name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid mt-2" style="max-height: 150px;">
                @endif
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-brand-yellow">
                Update
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-brand-black">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection

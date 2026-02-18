@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 products-title">Add New Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Product Name</label>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
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
                       value="{{ old('price_per_kg') }}"
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
                          rows="4">{{ old('description') }}</textarea>
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
                       value="{{ old('stock', 1) }}">
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
            </div>

        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-brand-yellow">
                Add Product
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-brand-black">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
/* Typography */
.products-title {
    color: var(--brand-black);
}

/* Buttons */
.btn-brand-red {
    background-color: var(--brand-red);
    border-color: var(--brand-red);
    color: #fff;
}

.btn-brand-red:hover {
    background-color: #d80000;
    border-color: #d80000;
    color: #fff;
}

.btn-brand-black {
    background-color: var(--brand-black);
    border-color: var(--brand-black);
    color: #fff;
}

.btn-brand-black:hover {
    background-color: #111;
    border-color: #111;
    color: #fff;
}

.btn-brand-yellow {
    background-color: var(--brand-yellow);
    border-color: var(--brand-yellow);
    color: var(--brand-black);
}

.btn-brand-yellow:hover {
    background-color: #e6b800;
    border-color: #e6b800;
    color: var(--brand-black);
}

/* Search input focus */
.search-input:focus {
    border-color: var(--brand-yellow);
    box-shadow: 0 0 0 0.2rem rgba(255, 198, 0, 0.25);
}
</style>
@endpush

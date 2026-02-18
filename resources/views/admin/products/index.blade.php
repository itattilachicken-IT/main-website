@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 products-title">All Products</h2>

        <a href="{{ route('admin.products.create') }}" class="btn btn-brand-red">
            + Add Product
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                class="form-control search-input"
                placeholder="Search products..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-brand-yellow" type="submit">
                Search
            </button>
        </div>
    </form>

    {{-- Products --}}
    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card product-card h-100">

                    {{-- Image --}}
                    <img
                        src="{{ $product->image
                            ? asset('storage/' . $product->image)
                            : asset('images/placeholder.png') }}"
                        class="card-img-top"
                        alt="{{ $product->name }}"
                    >

                    <div class="card-body d-flex flex-column">

                        {{-- Status --}}
                        <span class="badge badge-active mb-2">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>

                        <h5 class="card-title">{{ $product->name }}</h5>

                        <p class="text-muted small">
                            {{ Str::limit($product->description, 70) }}
                        </p>

                        {{-- Price --}}
                        <div class="product-price mb-3">
                            Ksh {{ number_format($product->price_per_kg, 2) }} / kg
                        </div>

                        {{-- Actions --}}
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.products.show', $product) }}"
                               class="btn btn-sm btn-brand-black w-100">
                                View
                            </a>

                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-sm btn-brand-yellow w-100">
                                Edit
                            </a>
                        </div>

                        <button
                            class="btn btn-sm btn-brand-red w-100 mt-2"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $product->id }}"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Delete Product</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Are you sure you want to delete
                            <strong>{{ $product->name }}</strong>?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-brand-black" data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-brand-red">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No products found.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>

</div>
@endsection

@push('styles')
<style>
/* Typography */
.products-title {
    color: var(--brand-black);
}

/* Card */
.product-card {
    border: none;
    background: #fff;
    transition: transform .2s ease, box-shadow .2s ease;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,.12);
}

/* Price */
.product-price {
    color: var(--brand-red);
    font-weight: 700;
    font-size: 1.05rem;
}

/* Badges */
.badge-active {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
}

/* Buttons */
/* View button */
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

/* Edit button */
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

/* Add Product / Delete buttons */
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

/* Search input */
.search-input:focus {
    border-color: var(--brand-yellow);
    box-shadow: 0 0 0 0.2rem rgba(255, 198, 0, 0.25);
}
</style>
@endpush



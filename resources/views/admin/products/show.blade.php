@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 products-title">{{ $product->name }}</h2>

        <div class="d-flex gap-2">
            {{-- Edit button → yellow --}}
            <a href="{{ route('admin.products.edit', $product) }}"
               class="btn btn-brand-yellow">
                Edit
            </a>

            {{-- Back button → black --}}
            <a href="{{ route('admin.products.index') }}"
               class="btn btn-brand-black">
                Back
            </a>

            {{-- Delete button → red --}}
            <button class="btn btn-brand-red" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                Delete
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.png') }}"
                     class="card-img-top"
                     alt="{{ $product->name }}">
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow-sm p-4">
                <p><strong>Description:</strong></p>
                <p>{{ $product->description }}</p>

                <p><strong>Price per kg:</strong> Ksh {{ number_format($product->price_per_kg,2) }}</p>

                <p><strong>Stock Status:</strong>
                    <span class="badge badge-active">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete <strong>{{ $product->name }}</strong>?
                </div>

                <div class="modal-footer">
                    {{-- Cancel → black --}}
                    <button class="btn btn-brand-black" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    {{-- Delete → red --}}
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
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

</div>
@endsection

@push('styles')
<style>
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

/* Badge */
.badge-active {
    background-color: var(--brand-yellow);
    color: var(--brand-black);
}
</style>
@endpush

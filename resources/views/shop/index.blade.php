@extends('layouts.app')

@section('content')
<style>
    body { background: #f5f5f5; color: #333; }
    h2 { color: #000; text-align: center; margin-bottom: 20px; }

    /* Product grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 15px;
    }
    @media (min-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 992px) { .product-grid { grid-template-columns: repeat(4, 1fr); } }

    /* Product card */
    .product-card {
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        color: #000;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(211,47,47,0.4);
    }

    .product-img-container {
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-img-container img { max-height: 100%; max-width: 100%; object-fit: contain; }

    /* Floating Cart Button */
    .cart-button {
        position: fixed;
        top: 70px;
        right: 20px;
        z-index: 1040;
        padding: 10px 18px;
        border-radius: 25px;
        background-color: #ffcc00;
        color: #000;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: 0.3s;
    }
    .cart-button:hover {
        background-color: #d32f2f;
        color: #fff;
    }

    /* Toasts */
    #cart-toast-error, #cart-toast-success {
        position: fixed;
        bottom: 20px;
        right: 20px;
        min-width: 220px;
        z-index: 2000;
    }
</style>

<!-- Floating Cart Button -->
<a href="{{ route('shop.cart.view') }}" class="btn cart-button">
    🛒 Cart (<span id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>)
</a>

<div class="container my-4">
    <h2 class="mb-4">Our Chicken Products</h2>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="card product-card">
                <div class="product-img-container">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ Str::limit($product->description, 80) }}</p>
                    <p class="fw-bold">Ksh {{ number_format($product->price_per_kg,2) }}/Kg</p>

                    <!-- Variant Selector -->
                    @if($product->variants && count($product->variants))
                        <select class="form-select form-select-sm mb-2 variant-selector">
                            @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}" data-price="{{ $variant->price }}">
                                    {{ $variant->name }} ({{ $variant->weight }}Kg) - Ksh {{ number_format($variant->price,2) }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <!-- Add to Cart Form -->
                    <form class="add-to-cart-form d-flex align-items-center mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" value="">
                        <div class="input-group input-group-sm me-2" style="max-width:90px;">
                            <button type="button" class="btn btn-outline-secondary decrement-btn">-</button>
                            <input type="number" name="quantity" value="1" min="1" class="form-control quantity-input">
                            <button type="button" class="btn btn-outline-secondary increment-btn">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No products available.</p>
        @endforelse
    </div>
</div>

<!-- Duplicate Item Confirmation Modal -->
<div class="modal fade" id="duplicateModal" tabindex="-1" aria-labelledby="duplicateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title" id="duplicateModalLabel">Item Already in Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        This item is already in your cart. Do you want to add more quantity?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirm-add-btn">Yes, Add More</button>
      </div>
    </div>
  </div>
</div>

<!-- Toasts -->
<div id="cart-toast-success" class="toast align-items-center text-bg-success border-0" role="alert">
    <div class="d-flex">
        <div class="toast-body">✅ Product added to cart!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>
<div id="cart-toast-error" class="toast align-items-center text-bg-danger border-0" role="alert">
    <div class="d-flex">
        <div class="toast-body">❌ Something went wrong.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const cartCount = document.getElementById("cart-count");
    const toastSuccess = new bootstrap.Toast(document.getElementById("cart-toast-success"));
    const toastError = new bootstrap.Toast(document.getElementById("cart-toast-error"));
    const duplicateModal = new bootstrap.Modal(document.getElementById("duplicateModal"));
    let pendingForm = null;

    // Variant selector
    document.querySelectorAll(".variant-selector").forEach(sel=>{
        sel.addEventListener("change", function(){
            const form = sel.closest(".product-card").querySelector(".add-to-cart-form");
            if(form) form.querySelector("input[name='variant_id']").value = sel.value;
        });
        sel.dispatchEvent(new Event("change"));
    });

    // Increment/Decrement buttons
    document.addEventListener("click", function(e){
        if(e.target.classList.contains("increment-btn") || e.target.classList.contains("decrement-btn")){
            const input = e.target.closest(".input-group").querySelector(".quantity-input");
            let val = parseInt(input.value);
            if(e.target.classList.contains("increment-btn")) val+=1;
            else val = Math.max(1,val-1);
            input.value = val;
        }
    });

    // Add to cart
    document.addEventListener("submit", function(e){
        if(e.target.matches(".add-to-cart-form")){
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('shop.cart.add') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    if(data.exists){
                        pendingForm = form;
                        duplicateModal.show();
                    } else {
                        cartCount.textContent = data.cart_count;
                        toastSuccess.show();
                    }
                } else {
                    toastError.show();
                }
            })
            .catch(()=>toastError.show());
        }
    });

    // Confirm duplicate add
    document.getElementById("confirm-add-btn").addEventListener("click", function(){
        if(!pendingForm) return;
        const formData = new FormData(pendingForm);

        fetch("{{ route('shop.cart.confirm') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                cartCount.textContent = data.cart_count;
                toastSuccess.show();
            } else toastError.show();
            pendingForm = null;
            duplicateModal.hide();
        })
        .catch(()=>{
            toastError.show();
            pendingForm = null;
            duplicateModal.hide();
        });
    });
});
</script>
@endpush

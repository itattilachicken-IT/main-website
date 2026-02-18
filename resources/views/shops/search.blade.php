@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Search results for "{{ $query }}"</h2>

    <div class="row">
        @forelse($results as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- Product image with modal --}}
                    <img src="{{ $product->image_url }}" 
                         class="card-img-top" 
                         alt="Attila {{ $product->name }}" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal-{{ $product->id }}">

                    <div class="card-body">
                        {{-- Product Name --}}
                        <h5 class="card-title">Attila {{ $product->name }}</h5>

                        {{-- Short description --}}
                        <p class="card-text text-muted">
                            {{ Str::limit($product->description, 100) }}
                        </p>

                        {{-- Price --}}
                        @if($product->variants->count() > 0)
                            <p class="fw-bold text-danger">
                                From KSh {{ number_format($product->variants->min('price'), 2) }}
                            </p>
                        @else
                            <p class="fw-bold text-danger">
                                KSh {{ number_format($product->price_per_kg, 2) }} /kg
                            </p>
                        @endif

                        {{-- Buttons --}}
                        <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-sm btn-warning">
                            View
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-sm fw-bold add-to-cart"
                                data-id="{{ $product->id }}"
                                data-has-variants="{{ $product->variants->count() > 0 ? '1' : '0' }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            {{-- Image Modal --}}
            <div class="modal fade" id="imageModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <img src="{{ $product->image_url }}" class="img-fluid" alt="Attila {{ $product->name }}">
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No products found matching your search.</p>
        @endforelse
    </div>
</div>

<!--
{{-- Floating Cart --}}
<a href="{{ route('cart.index') }}" 
   id="floating-cart" 
   class="position-fixed d-flex align-items-center justify-content-center rounded-circle shadow-lg">
    <span style="color: var(--brand-black); font-size: 24px;">🛒</span>
    <span id="cart-count" class="badge rounded-circle position-absolute top-0 start-100 translate-middle">
        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
    </span>
</a>-->

{{-- Variant Selection Modal (shared across products) --}}
<div class="modal fade" id="variantModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="variantForm">
            <div id="variantOptions"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="variantAddBtn" class="btn btn-primary">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

{{-- Toast Container --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
    <div id="cart-toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="cart-toast-body">Product added to cart!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<style>
:root {
    --brand-red: #fe0000;
    --brand-yellow: #ffc600;
    --brand-black: #000000;
}

#floating-cart {
    top: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: var(--brand-yellow);
    z-index: 9999;
    border: none;
}
#cart-count {
    font-size: 0.75rem;
    min-width: 20px;
    min-height: 20px;
    background-color: var(--brand-red);
    color: #fff;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    var toastEl = document.getElementById('cart-toast');
    var toast = new bootstrap.Toast(toastEl);
    var pendingProductId = null;

    function showToast(message, bgColor = 'bg-success') {
        $('#cart-toast').removeClass('bg-success bg-danger bg-warning').addClass(bgColor);
        $('#cart-toast-body').text(message);
        toast.show();
    }

    $('.add-to-cart').on('click', function () {
        let productId = $(this).data('id');
        let hasVariants = $(this).data('has-variants');
        pendingProductId = productId;

        if (hasVariants == 1) {
            $.ajax({
                url: '/product/' + productId + '/variants',
                type: 'GET',
                success: function(response) {
                    if(response.variants && response.variants.length > 0) {
                        let optionsHtml = '';
                        response.variants.forEach(v => {
                            optionsHtml += `
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="variant_id[]" value="${v.id}" id="variant-${v.id}">
                                <label class="form-check-label" for="variant-${v.id}">
                                  ${v.weight}kg – KSh ${parseFloat(v.price).toFixed(2)}
                                </label>
                              </div>
                            `;
                        });
                        $('#variantOptions').html(optionsHtml);

                        var modal = new bootstrap.Modal(document.getElementById('variantModal'));
                        modal.show();
                    } else {
                        addToCart(productId, null);
                    }
                },
                error: function(){
                    showToast('Error checking product variants!', 'bg-danger');
                }
            });
        } else {
            addToCart(productId, null);
        }
    });

    $('#variantAddBtn').on('click', function () {
        let selected = [];
        $('#variantForm input[name="variant_id[]"]:checked').each(function () {
            selected.push($(this).val());
        });

        if(selected.length === 0) {
            showToast('Please select at least one option!', 'bg-warning');
            return;
        }

        addToCart(pendingProductId, selected);
        var modal = bootstrap.Modal.getInstance(document.getElementById('variantModal'));
        modal.hide();
    });

    function addToCart(productId, variants) {
        $.ajax({
            url: '/cart/add/' + productId,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}', variants: variants},
            success: function(response) {
                let totalQty = 0;
                Object.values(response.cart).forEach(item => totalQty += item.quantity);
                $('#cart-count').text(totalQty);
                showToast(response.message, 'bg-success');
            },
            error: function(){ showToast('Something went wrong!', 'bg-danger'); }
        });
    }
});
</script>
@endsection

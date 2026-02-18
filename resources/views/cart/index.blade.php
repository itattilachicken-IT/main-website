@extends('layouts.app')

@section('title', 'Attila Chicken - Your Cart')

@section('content')
<div class="container">
    <h1 class="mb-4">Attila Chicken - Your Cart</h1>

    @php
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }
    @endphp

    <!-- Delivery type selector -->
    <div class="mb-3">
        <label class="form-label fw-bold">Select Delivery Type:</label>
        <select id="delivery-type" class="form-select w-auto">
            <option value="pickup" selected>Pickup (No minimum)</option>
            <option value="delivery">Home Delivery (Min KSh 2000)</option>
        </select>
    </div>

    <!-- Minimum order warning -->
    <div id="min-order-warning" style="display: none;">
        <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <span>Your order must be at least KSh 2000 for home delivery.</span>
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-warning fw-bold text-dark">
                Add more items
            </a>
        </div>
    </div>

    <!-- Cart content -->
    <div id="cart-content" style="{{ count($cart) === 0 ? 'display:none;' : '' }}">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; @endphp
                        <tr id="cart-row-{{ $id }}">
                            <td class="d-flex align-items-center">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50" class="me-2">
                                <div>
                                    {{ $item['name'] }}
                                    @isset($item['variant'])
                                        <br><small class="text-muted">({{ $item['variant'] }})</small>
                                    @endisset
                                </div>
                            </td>
                            <td>KSh {{ number_format($item['price'], 2) }}</td>
                            <td class="d-flex align-items-center">
                                <button type="button" class="btn btn-sm btn-secondary me-1 decrease-qty" data-id="{{ $id }}">-</button>
                                <span class="mx-1" id="qty-{{ $id }}">{{ $item['quantity'] }}</span>
                                <button type="button" class="btn btn-sm btn-secondary ms-1 increase-qty" data-id="{{ $id }}">+</button>
                            </td>
                            <td>KSh {{ number_format($subtotal, 2) }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-from-cart" data-id="{{ $id }}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Total:</td>
                        <td colspan="2" id="cart-total">KSh {{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('shop.index') }}" class="btn btn-success">➕ Add More Items</a>
            <a href="{{ route('checkout.index') }}" 
               class="btn btn-primary btn-sm fw-bold" 
               id="checkout-btn">
               Proceed to Checkout
            </a>
        </div>
    </div>

    <!-- Empty cart message -->
    <div id="empty-cart-message" class="text-center py-5" style="{{ count($cart) > 0 ? 'display:none;' : '' }}">
        <div class="alert alert-warning mb-4">Your cart is empty.</div>
        <a href="{{ route('shop.index') }}" class="btn btn-success btn-lg">➕ Add More Items</a>
    </div>
</div>

<!-- Toast notifications -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="cart-toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="cart-toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    var toastEl = document.getElementById('cart-toast');
    var toast = new bootstrap.Toast(toastEl);

    function showToast(message, success = true) {
        $('#cart-toast').removeClass('bg-success bg-danger').addClass(success ? 'bg-success' : 'bg-danger');
        $('#cart-toast-body').text(message);
        toast.show();
    }

    function updateMinOrderWarning(total) {
        const type = $('#delivery-type').val();
        if(type === 'delivery' && total < 2000 && total > 0){
            $('#min-order-warning').show();
        } else {
            $('#min-order-warning').hide();
        }
    }

    function updateMiniCart(cart) {
        let miniCartHtml = '';
        let totalQty = 0;
        Object.entries(cart).forEach(([key, item]) => {
            totalQty += item.quantity;
            miniCartHtml += `
                <li class="d-flex justify-content-between align-items-center" id="mini-cart-item-${key}">
                    ${item.name} x${item.quantity} - KSh ${(item.price * item.quantity).toFixed(2)}
                    <button class="btn btn-sm btn-danger remove-mini-item" data-id="${key}">x</button>
                </li>
            `;
        });
        $('#mini-cart').html(miniCartHtml);
        $('#cart-count').text(totalQty);
    }

    // Initial setup
    let total = {{ $total }};
    updateMinOrderWarning(total);
    updateMiniCart(@json($cart));

    // Update warning when delivery type changes
    $('#delivery-type').on('change', function(){
        updateMinOrderWarning(total);
    });

    // Quantity buttons
    $('.increase-qty, .decrease-qty').on('click', function () {
        let productId = $(this).data('id');
        let action = $(this).hasClass('increase-qty') ? 'increase' : 'decrease';

        $.ajax({
            url: '/cart/update/' + productId,
            type: 'POST',
            data: {_token: '{{ csrf_token() }}', action: action},
            success: function(response) {
                $('#qty-' + productId).text(response.cart[productId].quantity);
                let subtotal = response.cart[productId].price * response.cart[productId].quantity;
                $('#cart-row-' + productId + ' td:nth-child(4)').text('KSh ' + subtotal.toFixed(2));

                total = 0;
                Object.values(response.cart).forEach(item => { total += item.price * item.quantity; });
                $('#cart-total').text('KSh ' + total.toFixed(2));

                updateMinOrderWarning(total);
                updateMiniCart(response.cart);

                if(Object.keys(response.cart).length === 0){
                    $('#cart-content').hide();
                    $('#empty-cart-message').show();
                } else {
                    $('#cart-content').show();
                    $('#empty-cart-message').hide();
                }

                showToast('Quantity updated!', true);
            },
            error: function() {
                showToast('Something went wrong! Try again.', false);
            }
        });
    });

    // Remove item
    $('.remove-from-cart').on('click', function () {
        let productId = $(this).data('id');

        $.ajax({
            url: '/cart/remove/' + productId,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response) {
                $('#cart-row-' + productId).remove();

                total = 0;
                Object.values(response.cart).forEach(item => { total += item.price * item.quantity; });
                $('#cart-total').text('KSh ' + total.toFixed(2));

                updateMinOrderWarning(total);
                updateMiniCart(response.cart);

                if(Object.keys(response.cart).length === 0){
                    $('#cart-content').hide();
                    $('#empty-cart-message').show();
                }

                showToast(response.message, true);
            },
            error: function() {
                showToast('Something went wrong! Try again.', false);
            }
        });
    });
});
</script>
@endsection

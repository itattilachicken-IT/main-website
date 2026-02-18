@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">🛒 Your Cart</h1>

    @if(empty($cart))
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        <div id="cart-warning"></div> <!-- Warning placeholder -->

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th style="width: 120px;">Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $key => $item)
                        @php $itemTotal = $item['price'] * $item['quantity']; $grandTotal += $itemTotal; @endphp
                        <tr id="cart-row-{{ $key }}">
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <input type="number"
                                       class="form-control form-control-sm quantity-input"
                                       id="qty-{{ $key }}"
                                       name="quantity[{{ $key }}]"
                                       data-key="{{ $key }}"
                                       value="{{ $item['quantity'] }}"
                                       min="1">
                            </td>
                            <td>KES {{ number_format($item['price']) }}</td>
                            <td class="item-total">KES {{ number_format($itemTotal) }}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-outline-danger btn-sm remove-btn"
                                        data-key="{{ $key }}">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total: <span id="cart-total">KES {{ number_format($grandTotal) }}</span></h4>
            <a href="{{ route('checkout.show') }}" id="checkout-btn" class="btn btn-primary btn-lg">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){

    // Initial check
    checkMinimumOrder();

    // Update quantity when changed
    document.addEventListener("change", function(e){
        if(e.target.classList.contains("quantity-input")){
            const key = e.target.dataset.key;
            const quantity = e.target.value;
            updateQuantity(key, quantity);
        }
    });

    // Remove item when clicked
    document.addEventListener("click", function(e){
        if(e.target.classList.contains("remove-btn")){
            const key = e.target.dataset.key;
            updateQuantity(key, 0);
        }
    });

});

// Update quantity (global)
function updateQuantity(key, quantity){
    quantity = parseInt(quantity);
    if(isNaN(quantity) || quantity < 0) return;

    fetch("{{ route('shop.cart.update') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({key: key, quantity: quantity})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            refreshCart(data.cart);
        }
    })
    .catch(err => console.error("Cart update error:", err));
}

// Refresh cart DOM
function refreshCart(cart){
    let total = 0;

    for(const key in cart){
        const item = cart[key];
        const row = document.getElementById("cart-row-" + key);

        if(row){
            row.querySelector(".quantity-input").value = item.quantity;
            row.querySelector(".item-total").textContent = "KES " + (item.price * item.quantity).toLocaleString();
        }
        total += item.price * item.quantity;
    }

    // Remove rows for deleted items
    document.querySelectorAll("tr[id^='cart-row-']").forEach(row => {
        const key = row.id.replace("cart-row-","");
        if(!cart[key]){
            row.remove();
        }
    });

    document.getElementById("cart-total").textContent = "KES " + total.toLocaleString();

    // If cart empty, reload page
    if(Object.keys(cart).length === 0){
        location.reload();
    }

    checkMinimumOrder();
}

// Check minimum order (2000 KES)
function checkMinimumOrder(){
    const totalText = document.getElementById("cart-total").textContent.replace(/[^\d]/g, "");
    const total = parseInt(totalText);

    const warningContainer = document.getElementById("cart-warning");
    const checkoutBtn = document.getElementById("checkout-btn");

    if(total < 2000){
        warningContainer.innerHTML = `
            <div class="alert alert-warning">
                ⚠️ Minimum order is <strong>KES 2000</strong>. Please add more items to proceed.
            </div>`;
        if(checkoutBtn){
            checkoutBtn.setAttribute("disabled", "disabled");
            checkoutBtn.classList.add("disabled");
        }
    } else {
        warningContainer.innerHTML = "";
        if(checkoutBtn){
            checkoutBtn.removeAttribute("disabled");
            checkoutBtn.classList.remove("disabled");
        }
    }
}
</script>
@endsection

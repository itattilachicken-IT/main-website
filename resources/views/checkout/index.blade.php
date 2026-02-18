@extends('layouts.app')

@section('content')
<div class="container py-2">
    <h1 class="mb-3">Attila Chicken - Checkout</h1>

    @php
        $cart = session('cart', []);
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $deliveryFee = 300;
        $minOrder = 2000;
        $total = $subtotal + $deliveryFee;
        $minimumDeposit = round((0.3 * $subtotal) + $deliveryFee, 2);
    @endphp

    @if(count($cart) === 0)
        <div class="alert alert-warning">
            Your cart is empty. <a href="{{ route('shop.index') }}" class="fw-bold">Continue shopping</a>
        </div>
    @else

    {{-- Delivery Method --}}
    <div class="mb-3 card p-3 shadow-sm">
        <h5 class="fw-bold mb-2">Choose Delivery Method</h5>
        {{-- Hidden input to submit actual value --}}
        <input type="hidden" name="delivery_method" id="hidden_delivery_method" value="home_delivery">

        <div class="form-check">
            <input type="radio" name="delivery_method_radio" value="home_delivery" class="form-check-input" id="dm-home" checked>
            <label class="form-check-label" for="dm-home">Home Delivery</label>
        </div>
        <div class="form-check">
            <input type="radio" name="delivery_method_radio" value="pickup" class="form-check-input" id="dm-pickup">
            <label class="form-check-label" for="dm-pickup">Pickup</label>
        </div>
    </div>

    {{-- Order Summary --}}
    <div class="card p-3 mb-3 shadow-sm">
        <h5 class="fw-bold mb-2">Order Summary</h5>
        <div class="d-flex justify-content-between">
            <span>Subtotal:</span>
            <span>KSh <span id="subtotal">{{ number_format($subtotal,2) }}</span></span>
        </div>
        <div class="d-flex justify-content-between" id="delivery-fee-row">
            <span>Delivery Fee:</span>
            <span>KSh <span id="delivery-fee">{{ number_format($deliveryFee,2) }}</span></span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold">
            <span>Total:</span>
            <span>KSh <span id="total">{{ number_format($total,2) }}</span></span>
        </div>
        <div class="d-flex justify-content-between small text-muted">
            <span>Minimum Deposit:</span>
            <span>KSh <span id="deposit">{{ number_format($minimumDeposit,2) }}</span></span>
        </div>
        <div class="alert alert-warning mt-2 d-none" id="min-order-warning">
            Add at least <strong>KSh <span id="amount-needed"></span></strong> more to reach the minimum order of KSh {{ number_format($minOrder,2) }}.
        </div>
    </div>

    {{-- Checkout Form --}}
    <form method="POST" action="{{ route('checkout.placeOrder') }}" class="card p-3 shadow-sm border-0">
        @csrf
        <div class="row g-3">

            {{-- Name --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            {{-- Phone --}}
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone</label>
                <input type="tel" name="phone" class="form-control" required>
            </div>

            {{-- Alternative Phone --}}
            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check mt-2">
                    <input type="checkbox" id="use_alt_phone" class="form-check-input">
                    <label for="use_alt_phone" class="form-check-label fw-bold">Pay using a different phone?</label>
                </div>
            </div>
            <div class="col-md-6" id="alt-phone-container" style="display:none;">
                <label for="payment_phone" class="form-label fw-bold">Alternative Payment Phone</label>
                <input type="tel" name="payment_phone" id="payment_phone" class="form-control" placeholder="Used for STK push if different">
            </div>

            {{-- Home Delivery Fields --}}
            <div class="col-md-6" id="route-container">
                <label class="form-label fw-bold">Delivery Route</label>
                <select name="route_id" id="route_id" class="form-select">
                    <option value="">Select a route</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}" data-delivery-day="{{ $route->delivery_day ?? '' }}">{{ $route->name }}</option>
                    @endforeach
                </select>
                <div id="deliveryDay" class="mt-1 text-success fw-bold"></div>
            </div>
            <div class="col-md-6" id="address-container">
                <label class="form-label fw-bold">Delivery Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            {{-- Pickup Location --}}
            <div class="col-md-6 d-none" id="pickup-container">
                <label class="form-label fw-bold">Pickup Location</label>
                <select name="pickup_location" class="form-select">
                    <option value="">Select store</option>
                    <option value="store_1">Attila Chicken Downtown</option>
                    <option value="store_2">Attila Chicken Westside</option>
                    <option value="store_3">Attila Chicken Eastside</option>
                </select>
            </div>

            {{-- Payment Options --}}
            <div class="col-12">
                <label class="form-label fw-bold">Payment Option</label>
                <div class="form-check">
                    <input type="radio" name="payment_option" value="full" class="form-check-input" checked>
                    <label class="form-check-label">Pay Full Amount (KSh <span id="pay-full">{{ number_format($total,2) }}</span>)</label>
                </div>
                <div class="form-check" id="deposit-option">
                    <input type="radio" name="payment_option" value="deposit" class="form-check-input">
                    <label class="form-check-label">Pay Minimum Deposit (KSh <span id="pay-deposit">{{ number_format($minimumDeposit,2) }}</span>)</label>
                </div>
            </div>

            {{-- Hidden Cart --}}
            @foreach($cart as $index => $item)
                <input type="hidden" name="cart[{{ $index }}][product_id]" value="{{ $item['product_id'] }}">
                <input type="hidden" name="cart[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                <input type="hidden" name="cart[{{ $index }}][price]" value="{{ $item['price'] }}">
                <input type="hidden" name="cart[{{ $index }}][variant_id]" value="{{ $item['variant_id'] ?? '' }}">
            @endforeach
        </div>

        <button type="submit" id="proceed-btn" class="btn btn-warning fw-bold w-100 mt-3">
            Proceed to Payment
        </button>
    </form>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const subtotal = {{ $subtotal }};
    const deliveryFee = 300;
    const minOrder = 2000;

    const totalEl = document.getElementById('total');
    const depositEl = document.getElementById('deposit');
    const payFullEl = document.getElementById('pay-full');
    const payDepositEl = document.getElementById('pay-deposit');
    const proceedBtn = document.getElementById('proceed-btn');

    const address = document.getElementById('address-container');
    const pickup = document.getElementById('pickup-container');
    const route = document.getElementById('route-container');
    const routeSelect = document.getElementById('route_id');
    const deliveryDayDiv = document.getElementById('deliveryDay');

    const minOrderWarning = document.getElementById('min-order-warning');
    const amountNeededEl = document.getElementById('amount-needed');

    const depositRadio = document.querySelector('#deposit-option input');

    const altCheckbox = document.getElementById('use_alt_phone');
    const altContainer = document.getElementById('alt-phone-container');
    const altPhoneInput = document.getElementById('payment_phone');

    // Alt phone toggle
    altCheckbox.addEventListener('change', function() {
        altContainer.style.display = this.checked ? 'block' : 'none';
        altPhoneInput.required = this.checked;
        if(!this.checked) altPhoneInput.value = '';
    });

    function showDeliveryDay(){
        const opt = routeSelect.options[routeSelect.selectedIndex];
        deliveryDayDiv.textContent = opt?.dataset.deliveryDay ? `Delivery Day: ${opt.dataset.deliveryDay}` : '';
    }
    routeSelect.addEventListener('change', showDeliveryDay);

    function recalc(method){
        const fee = method === 'home_delivery' ? deliveryFee : 0;
        const total = subtotal + fee;
        const deposit = 0.3 * subtotal + fee;

        document.getElementById('delivery-fee').textContent = fee.toFixed(2);
        totalEl.textContent = total.toFixed(2);
        depositEl.textContent = deposit.toFixed(2);
        payFullEl.textContent = total.toFixed(2);
        payDepositEl.textContent = deposit.toFixed(2);

        address.classList.toggle('d-none', method === 'pickup');
        route.classList.toggle('d-none', method === 'pickup');
        pickup.classList.toggle('d-none', method === 'home_delivery');

        routeSelect.required = method === 'home_delivery';
        document.querySelector('textarea[name="address"]').required = method === 'home_delivery';

        if(method === 'home_delivery' && subtotal < minOrder){
            amountNeededEl.textContent = (minOrder - subtotal).toFixed(2);
            minOrderWarning.classList.remove('d-none');
            proceedBtn.disabled = true;
            depositRadio.disabled = true;
        } else {
            minOrderWarning.classList.add('d-none');
            proceedBtn.disabled = false;
            depositRadio.disabled = false;
        }

        showDeliveryDay();

        // Sync hidden input for controller
        document.getElementById('hidden_delivery_method').value = method;
    }

    document.querySelectorAll('input[name="delivery_method_radio"]').forEach(radio => {
        radio.addEventListener('change', () => recalc(radio.value));
    });

    // Initialize
    recalc(document.querySelector('input[name="delivery_method_radio"]:checked').value);
});
</script>
@endsection

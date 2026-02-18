@extends('layouts.app')

@section('content')
<div class="container py-2">
    <h1 class="mb-3">Select Payment Method</h1>

    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $deliveryFee = 300; // Fixed delivery fee
        $total = $subtotal + $deliveryFee;
    @endphp

    @if(count($cart) == 0)
        <div class="alert alert-warning">
            Your cart is empty. <a href="{{ route('shop.index') }}">Continue shopping</a>
        </div>
    @elseif($subtotal < 2000)
        <div class="alert alert-warning">
            Minimum order for checkout is KSh 2000. <a href="{{ route('shop.index') }}">Add more items</a>
        </div>
    @else
       
        <div class="card p-2 shadow-sm mb-3" style="background-color: #fff8e1;">
            <h5 class="fw-bold mb-2">Order Summary</h5>
            <div class="d-flex justify-content-between">
                <span>Subtotal:</span>
                <span>KSh {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Delivery Fee:</span>
                <span>KSh {{ number_format($deliveryFee, 2) }}</span>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between fw-bold">
                <span>Total:</span>
                <span>KSh {{ number_format($total, 2) }}</span>
            </div>
        </div>

       
        <form action="{{ route('checkout.stkPush') }}" method="POST" class="card p-3 shadow-sm">
            @csrf
            
            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
            <input type="hidden" name="delivery_fee" value="{{ $deliveryFee }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="payment_method" value="mpesa">

            <div class="checkout-payment row g-3 mt-2">
                <div class="col-12 col-md-4">
                    <div class="form-check d-flex align-items-center p-2 border rounded hover-shadow">
                        <input class="form-check-input me-2" type="radio" name="payment_method_select" id="mpesa" value="mpesa" checked disabled>
                        <label class="form-check-label d-flex align-items-center mb-0" for="mpesa">
                            <img src="{{ asset('images/logos/mpesa.png') }}" alt="M-Pesa" width="32" class="me-2">
                            <span class="d-none d-md-inline">M-Pesa</span>
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-check d-flex align-items-center p-2 border rounded hover-shadow opacity-50">
                        <input class="form-check-input me-2" type="radio" name="payment_method_select" id="paypal" value="paypal" disabled>
                        <label class="form-check-label d-flex align-items-center mb-0" for="paypal">
                            <img src="{{ asset('images/logos/paypal.png') }}" alt="PayPal" width="32" class="me-2">
                            <span class="d-none d-md-inline">PayPal</span>
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-check d-flex align-items-center p-2 border rounded hover-shadow opacity-50">
                        <input class="form-check-input me-2" type="radio" name="payment_method_select" id="card" value="card" disabled>
                        <label class="form-check-label d-flex align-items-center mb-0" for="card">
                            <img src="{{ asset('images/logos/visa.png') }}" alt="Card" width="32" class="me-2">
                            <span class="d-none d-md-inline">Card</span>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning fw-bold text-dark w-100 mt-3 hover-shadow">
                Proceed to Pay
            </button>
        </form>
    @endif
</div>
@endsection

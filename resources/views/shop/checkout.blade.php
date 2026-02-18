@extends('layouts.app')

@section('content')
<style>
    .checkout-container { max-width: 700px; margin: 20px auto; padding: 15px; background: #fff; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.05); }
    h2 { text-align:center; margin-bottom:15px; }
    .form-group { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:10px; align-items:center; }
    .form-group label { min-width:120px; font-weight:bold; }
    .form-group input, .form-group select, .form-group textarea { flex:1; padding:6px 8px; border:1px solid #ccc; border-radius:5px; }
    .total-box, .deposit-box { padding:8px 12px; border-radius:5px; margin-bottom:10px; }
    .total-box { background:#f0f0f0; font-weight:bold; text-align:right; }
    .deposit-box { background:#fff3cd; color:#856404; font-weight:bold; text-align:right; }
    .btn-place { width:100%; padding:10px; font-weight:bold; }
    .add-more-btn { margin-bottom: 15px; display: inline-block; }
    @media(max-width:480px){ .form-group label{ min-width:100%; } }
</style>

<div class="checkout-container">
    <h2>🛒 Checkout</h2>

    @php
        $subtotal = 0;
        foreach($cart as $item) {
            $price = $item['price'] ?? $item['price_per_kg'];
            $subtotal += $price * $item['quantity'];
        }
        $minOrderReached = $subtotal >= 2000;
        $deliveryFee = 300;
    @endphp

    @if(!$minOrderReached)
        <div class="alert alert-warning text-center mb-3">
            ⚠️ Minimum order KES 2000 (excluding delivery). Add more items to proceed.
        </div>
    @endif

    {{-- Add More Items --}}
    <a href="{{ route('shop.index') }}" class="btn btn-warning add-more-btn">➕ Add More Items</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" required>
        </div>

        {{-- Delivery address & route (always required) --}}
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="1" required></textarea>
        </div>

        <div class="form-group">
            <label for="route_id">Delivery Route</label>
            <select name="route_id" id="route_id" required>
                <option value="">Select Route</option>
                @foreach($routes as $route)
                    <option value="{{ $route->id }}">{{ $route->name }} ({{ $route->delivery_day }})</option>
                @endforeach
            </select>
        </div>

        <div class="total-box">
            Subtotal: KES {{ number_format($subtotal,2) }} <br>
            Delivery Fee: KES {{ number_format($deliveryFee,2) }} <br>
            Total: KES {{ number_format($subtotal+$deliveryFee,2) }}
        </div>

        @if($minOrderReached)
            <div class="deposit-box">
                Minimum Deposit: KES {{ number_format(round($subtotal*0.3 + $deliveryFee,2),2) }}
            </div>

            <div class="form-group">
                <label>Payment Option</label>
                <div>
                    <label>
                        <input type="radio" name="payment_type" value="deposit" checked>
                        Deposit: KES {{ number_format(round($subtotal*0.3 + $deliveryFee,2),2) }}
                    </label><br>
                    <label>
                        <input type="radio" name="payment_type" value="full">
                        Full: KES {{ number_format($subtotal+$deliveryFee,2) }}
                    </label>
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-primary btn-place" {{ !$minOrderReached ? 'disabled' : '' }}>
            ✅ Place Order
        </button>
    </form>
</div>
@endsection

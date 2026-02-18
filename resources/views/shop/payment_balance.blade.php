@extends('layouts.app')

@section('content')
<style>
.payment-card { border: 1px solid #ddd; border-radius: 12px; background: #fff; padding: 20px; margin: 15px auto; max-width: 700px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
.payment-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 15px; }
.payment-option { display: flex; align-items: center; padding: 12px 15px; border: 1px solid #ccc; border-radius: 8px; cursor: pointer; transition: background 0.2s, box-shadow 0.2s, border 0.2s; background: #fff; }
.payment-option:hover { background: #f8f9fa; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
.payment-option input { margin-right: 15px; transform: scale(1.3); }
.payment-logo { width: 60px; height: auto; margin-right: 12px; }
.payment-label { font-weight: 600; font-size: 1.1rem; }
.payment-summary { margin-bottom: 15px; }
.test-buttons a { margin-right: 10px; margin-top: 5px; }
</style>

<div class="container my-4">
    <div class="payment-card">
        <h4 class="text-center mb-4">Pending Balance Payment</h4>

        {{-- Payment summary --}}
        <div class="payment-summary">
            <p><strong>Order Total:</strong> KES {{ number_format($order->total_amount, 0) }}</p>
            <p class="text-warning"><strong>Balance Payable Now:</strong> KES {{ number_format($payable, 0) }}</p>
            <p class="text-muted"><em>Please pay the remaining balance on or before delivery.</em></p>
        </div>

        <form action="{{ route('checkout.process_payment', $order->id) }}" method="POST">
            @csrf

            <div class="payment-grid">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="mpesa" required>
                    <img src="{{ asset('images/logos/mpesa.png') }}" class="payment-logo"> <span class="payment-label">M-Pesa</span>
                </label>
                
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="paypal" required>
                    <img src="{{ asset('images/logos/paypal.png') }}" class="payment-logo"> <span class="payment-label">PayPal</span>
                </label>
                <!-- Airtel Money -->
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="airtel" required>
                    <img src="{{ asset('images/logos/airtel.png') }}" class="payment-logo" alt="Airtel Money Logo">
                    <span class="payment-label">Airtel Money</span>
                </label>

                <!-- Visa -->
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="visa" required>
                    <img src="{{ asset('images/logos/visa.png') }}" class="payment-logo" alt="Visa Logo">
                    <span class="payment-label">Visa</span>
                </label>

                <!-- Mastercard -->
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="mastercard" required>
                    <img src="{{ asset('images/logos/mastercard.png') }}" class="payment-logo" alt="Mastercard Logo">
                    <span class="payment-label">Mastercard</span>
                </label>

                

                <!-- Bank Transfer -->
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="bank_transfer" required>
                    <img src="{{ asset('images/logos/bank.png') }}" class="payment-logo" alt="Bank Transfer Logo">
                    <span class="payment-label">Bank Transfer</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">✅ Proceed to Pay Balance</button>
        </form>

        
    </div>
</div>
@endsection

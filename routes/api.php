<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;


Route::post('/checkout/stk-callback', [CheckoutController::class, 'stkCallback']);

Route::post('/checkout/stkpush', [CheckoutController::class, 'stkPush']);

Route::post('/checkout/test-stkpush/{orderId}', [CheckoutController::class, 'stkPush']);

Route::get('/admin/maintenance-status', [MaintenanceController::class, 'status']);


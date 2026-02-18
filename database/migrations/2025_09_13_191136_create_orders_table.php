<?php

// database/migrations/2025_09_13_000001_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('delivery_fee', 12, 2)->default(300);
            $table->string('status')->default('pending'); // pending, confirmed, delivered, cancelled
            $table->boolean('timed_out')->default(false);
            $table->string('payment_gateway')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};

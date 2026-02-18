<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable()->after('customer_phone');
            }
            if (!Schema::hasColumn('orders', 'route_id')) {
                $table->unsignedBigInteger('route_id')->nullable()->after('customer_address');
            }
            if (!Schema::hasColumn('orders', 'order_type')) {
                $table->string('order_type')->default('delivery')->after('route_id'); // delivery or pickup
            }
            if (!Schema::hasColumn('orders', 'guest_token')) {
                $table->uuid('guest_token')->nullable()->after('status');
            }
        });
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_email', 'route_id', 'order_type', 'guest_token']);
        });
    }
};

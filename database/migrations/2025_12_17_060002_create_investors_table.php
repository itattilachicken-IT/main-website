<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('id_number')->unique();
            $table->string('kra_pin')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('postal_address');
            $table->string('investment_package');
            $table->string('contract_number')->unique();
            $table->date('initial_investment_date');
            $table->decimal('total_amount_invested', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};

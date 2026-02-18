<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('investor_id')->constrained('investors')->onDelete('cascade');
    $table->string('investment_package');
    $table->string('contract_number')->unique();
    $table->date('initial_investment_date');
    $table->unsignedBigInteger('total_amount_invested'); // store in KES
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};

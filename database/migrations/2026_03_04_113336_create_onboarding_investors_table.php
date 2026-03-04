<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('onboarding_investors', function (Blueprint $table) {
        $table->id();

        // Step 1 - Account
        $table->string('investor_code')->unique();
        $table->string('full_name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('password');

        // Step 2 - Investment
        $table->string('investment_package')->nullable();
        $table->integer('number_of_birds')->nullable();
        $table->integer('feeds_bags')->nullable();
        $table->decimal('cost_of_feeds', 15, 2)->nullable();
        $table->decimal('insurance', 15, 2)->nullable();
        $table->decimal('total_investment', 15, 2)->nullable();
        $table->decimal('total_package_cost', 15, 2)->nullable();

        // Step 3 - Bank
        $table->string('bank_name')->nullable();
        $table->string('bank_address')->nullable();
        $table->string('account_name')->nullable();
        $table->string('account_number')->nullable();
        $table->string('swift_code')->nullable();
        $table->string('branch_name')->nullable();

        // Step 4 - Contract
        $table->string('contract_file')->nullable();

        $table->string('status')->default('Active');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_investors');
    }
};

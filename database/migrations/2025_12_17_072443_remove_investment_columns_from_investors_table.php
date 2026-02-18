<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->dropColumn([
                'investment_package',
                'contract_number',
                'initial_investment_date',
                'total_amount_invested'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('investors', function (Blueprint $table) {
            $table->string('investment_package')->nullable();
            $table->string('contract_number')->nullable();
            $table->date('initial_investment_date')->nullable();
            $table->unsignedBigInteger('total_amount_invested')->nullable();
        });
    }
};

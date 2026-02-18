<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained('investors')->onDelete('cascade');
            $table->enum('type_of_withdrawal', ['full', 'partial']);
            $table->decimal('amount_requested', 15, 2);
            $table->text('reason')->nullable();
            $table->date('preferred_payment_date');
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('signature')->nullable();
            $table->date('signature_date')->nullable();
            $table->string('application_received_by')->nullable();
            $table->date('date_received')->nullable();
            $table->decimal('approved_amount', 15, 2)->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'deferred', 'declined'])->default('pending');
            $table->text('comments')->nullable();
            $table->string('authorized_by')->nullable();
            $table->string('authorized_signature')->nullable();
            $table->date('authorized_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};

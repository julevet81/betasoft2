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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['salary', 'bonus', 'client_payment']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade'); // Optional: if payments are linked to projects
            $table->date('payment_date')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'partially_completed'])->default('pending'); // Optional: to track payment status
            $table->enum('method', ['cash', 'bank_transfer', 'credit_card', 'paypal'])->default('bank_transfer'); // Optional: to track payment method
            $table->string('reference')->nullable(); // Optional: to store transaction ID for
            $table->longText('notes')->nullable(); // Optional: to store additional information about the payment
            $table->timestamps();
            $table->softDeletes(); // Optional: if you want to use soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

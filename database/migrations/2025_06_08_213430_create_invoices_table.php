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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->decimal('amount');
            $table->decimal('due')->default(0);
            $table->decimal('paid')->default(0);
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->date('date')->nullable();
            $table->string('note')->nullable();
            $table->string('invoice_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

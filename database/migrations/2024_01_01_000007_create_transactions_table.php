<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code', 20)->unique();
            $table->foreignId('reservation_id')->unique()->constrained('reservations')->cascadeOnDelete();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->string('payment_method', 50)->nullable();
            $table->dateTime('transaction_date');
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

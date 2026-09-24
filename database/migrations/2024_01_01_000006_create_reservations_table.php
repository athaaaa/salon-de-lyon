<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code', 20)->unique();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('stylist_id')->constrained('stylists')->restrictOnDelete();
            $table->foreignId('treatment_id')->constrained('treatments')->restrictOnDelete();
            $table->date('reservation_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('source', ['Web/App Customer', 'WhatsApp', 'Telepon', 'Instagram', 'Admin'])
                ->default('Web/App Customer');
            $table->enum('status', ['Menunggu Konfirmasi', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'])
                ->default('Menunggu Konfirmasi');
            $table->text('notes')->nullable();
            $table->string('cancelled_reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['stylist_id', 'reservation_date', 'start_time', 'end_time'], 'idx_jadwal_stylist');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

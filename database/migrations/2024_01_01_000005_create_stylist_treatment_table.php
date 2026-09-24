<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stylist_treatment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stylist_id')->constrained('stylists')->cascadeOnDelete();
            $table->foreignId('treatment_id')->constrained('treatments')->cascadeOnDelete();
            $table->unique(['stylist_id', 'treatment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stylist_treatment');
    }
};

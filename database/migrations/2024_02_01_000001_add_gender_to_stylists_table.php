<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration tambahan (dibuat terpisah, bukan mengedit migration stylists yang lama,
     * supaya cukup jalankan `php artisan migrate` tanpa perlu migrate:fresh kalau
     * database kalian sudah berjalan).
     */
    public function up(): void
    {
        Schema::table('stylists', function (Blueprint $table) {
            $table->enum('gender', ['L', 'P'])->default('P')->after('specialization');
        });
    }

    public function down(): void
    {
        Schema::table('stylists', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};

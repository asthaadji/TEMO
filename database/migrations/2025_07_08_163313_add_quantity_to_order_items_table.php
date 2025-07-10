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
        Schema::table('order_items', function (Blueprint $table) {
            // Menambah kolom 'quantity' sebagai integer, tidak boleh negatif, default 1
            // Ditempatkan setelah kolom 'product_id' (opsional, untuk kerapian)
            $table->unsignedInteger('quantity')->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Menghapus kolom 'quantity' jika migrasi di-rollback
            $table->dropColumn('quantity');
        });
    }
};
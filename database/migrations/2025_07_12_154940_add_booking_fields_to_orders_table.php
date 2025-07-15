<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Livewire\after;

/**
 * File: 2025_07_12_154500_add_booking_fields_to_orders_table.php
 * * Menambahkan kolom 'product_id' dan 'tanggal_pemesanan' ke tabel 'orders'
 * untuk mendukung fitur pemesanan berdasarkan tanggal.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * * Metode ini akan menambahkan kolom baru ke dalam skema tabel 'orders'.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan foreign key ke tabel 'products'.
            // Kolom ini ditempatkan setelah kolom 'user_id' untuk kerapian.
            $table->foreignId('product_id')
                  ->after('user_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Menambahkan kolom untuk menyimpan tanggal pemesanan.
            // Ditempatkan setelah 'product_id'.
            $table->date('tanggal_pemesanan')->after('product_id');
            $table->string('merchant_ref')->unique()->after('tanggal_pemesanan');
            $table->string('payment_code')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     * * Metode ini akan menghapus kolom yang ditambahkan oleh metode up(),
     * mengembalikan skema tabel ke kondisi semula.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Penting untuk menghapus foreign key constraint terlebih dahulu
            // sebelum menghapus kolomnya untuk menghindari error.
            $table->dropForeign(['product_id']);

            // Menghapus kolom yang telah ditambahkan.
            $table->dropColumn(['product_id', 'tanggal_pemesanan', 'merchant_ref', 'payment_code']);
        });
    }
};

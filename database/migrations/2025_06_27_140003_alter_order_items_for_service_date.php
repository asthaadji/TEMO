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
            Schema::table('order_items', function (Blueprint $table) {
            // 1. Hapus kolom 'quantity' yang sudah tidak relevan
            $table->dropColumn('quantity');

            // 2. Tambahkan kolom baru untuk tanggal pemakaian jasa.
            // Kita letakkan setelah product_id agar rapi.
            // Tipe 'date' cocok jika Anda hanya butuh tanggal tanpa jam.
            $table->date('service_date')->after('product_id');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
             // 1. Hapus kolom 'service_date' yang baru kita buat
            $table->dropColumn('service_date');
            
            // 2. Kembalikan kolom 'quantity' seperti semula
            $table->integer('quantity')->after('product_id');
        });
    }
};

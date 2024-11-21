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
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Menyimpan ID pemesanan
            $table->decimal('jumlah_pembayaran', 10, 2); // Menyimpan jumlah pembayaran
            $table->string('metode_pembayaran'); // Menyimpan metode pembayaran
            $table->timestamp('tanggal_pembayaran')->nullable(); // Menyimpan tanggal pembayaran
            $table->string('status')->default('pending'); // Status pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at
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

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelinci'); // Nama kelinci
            $table->integer('umur'); // Umur kelinci dalam bulan
            $table->integer('stok'); // Stok kelinci yang tersedia
            $table->decimal('harga', 10, 2); // Harga kelinci, 10 digit total dengan 2 digit desimal
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

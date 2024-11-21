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
        Schema::create('device', function (Blueprint $table) {
            $table->string('id_device')->primary(); // Nama pembeli
            $table->string('password'); // Nama pembeli
            $table->unsignedBigInteger('id');
            $table->string('nama_device'); // Tanggal penjualan
            $table->integer('status')->default(0);
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device');
    }
};

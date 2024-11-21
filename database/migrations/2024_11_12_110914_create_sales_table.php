<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name'); // Nama pembeli
            $table->date('sale_date'); // Tanggal penjualan
            $table->integer('quantity'); // Jumlah kelinci yang terjual
            $table->string('rabbit_type'); // Jenis kelinci
            $table->string('payment_method'); // Metode pembayaran
            $table->string('payment_status'); // Status pembayaran
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};

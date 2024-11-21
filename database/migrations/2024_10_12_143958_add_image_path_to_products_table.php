<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan kolom 'image_path' untuk menyimpan path gambar
            $table->string('image_path')->nullable()->after('harga');
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menghapus kolom 'image_path' jika migrasi di-rollback
            $table->dropColumn('image_path');
        });
    }
};

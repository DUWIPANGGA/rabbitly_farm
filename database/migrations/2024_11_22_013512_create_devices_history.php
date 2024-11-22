<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('device_history', function (Blueprint $table) {
            $table->id();  // Auto-increment ID
            $table->string('id_device');  // This will reference the `id_device` in `devices` table
            $table->string('nama_device');  // Location Name
            $table->boolean('status_lampu');  // Status of the device (on/off)
            $table->timestamps();  // Created at and updated at timestamps
            $table->foreign('id_device')->references('id_device')->on('device')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_history');
    }
};

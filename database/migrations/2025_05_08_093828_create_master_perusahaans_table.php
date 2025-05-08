<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('Nama')->nullable();
            $table->string('Alamat')->nullable();
            $table->string('Kota')->nullable();
            $table->string('Provinsi')->nullable();
            $table->string('KodePos')->nullable();
            $table->string('Telepon')->nullable();
            $table->string('Email')->nullable();
            $table->string('Direktur')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_perusahaans');
    }
};

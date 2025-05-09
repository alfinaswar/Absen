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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->date('tanggal');
            $table->time('waktu_absen')->nullable();
            $table->enum('jenis_absen', ['Masuk', 'Keluar', 'Cuti', 'Sakit'])->nullable();
            $table->enum('ontime', ['Y', 'N'])->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('approval', ['Y', 'N'])->nullable()->default('N');
            $table->string('file_pendukung')->nullable();
            $table->longText('selfie_photo')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};

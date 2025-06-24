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
        Schema::create('over_times', function (Blueprint $table) {
            $table->id();
            $table->string('NamaKaryawan', 100)->nullable();
            $table->string('KodePerusahaan', 100)->nullable();
            $table->date('Tanggal')->nullable();
            $table->time('JamMulai')->nullable();
            $table->time('JamSelesai')->nullable();
            $table->string('Durasi')->nullable();
            $table->string('Kegiatan', 255)->nullable();
            $table->enum('Status', ['Diajukan', 'Diterima', 'Ditolak'])->default('Diajukan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('over_times');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Informasi Akun
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();

            // Informasi Pribadi
            $table->string('nip')->unique()->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->nullable();
            $table->enum('status_pernikahan', ['Lajang', 'Menikah', 'Cerai'])->nullable();
            $table->string('no_hp')->nullable();
            $table->string('foto_profile')->nullable();

            // Alamat
            $table->text('alamat_ktp')->nullable();
            $table->string('provinsi_ktp')->nullable();
            $table->string('kota_ktp')->nullable();
            $table->string('kecamatan_ktp')->nullable();
            $table->string('kelurahan_ktp')->nullable();
            $table->string('kode_pos_ktp')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->string('provinsi_domisili')->nullable();
            $table->string('kota_domisili')->nullable();
            $table->string('kecamatan_domisili')->nullable();
            $table->string('kelurahan_domisili')->nullable();
            $table->string('kode_pos_domisili')->nullable();

            // Informasi Kepegawaian
            $table->string('jabatan')->nullable();
            $table->string('departemen')->nullable();
            $table->string('divisi')->nullable();
            $table->string('grade')->nullable();
            $table->string('level')->nullable();
            $table->enum('status_kepegawaian', ['Tetap', 'Kontrak', 'Magang', 'Outsource'])->nullable();
            $table->date('tanggal_bergabung')->nullable();
            $table->date('tanggal_berakhir_kontrak')->nullable();

            // Informasi Pendidikan
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('institusi_pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();

            // Informasi Darurat
            $table->string('kontak_darurat_nama')->nullable();
            $table->string('kontak_darurat_hubungan')->nullable();
            $table->string('kontak_darurat_telepon')->nullable();

            // Informasi Bank
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_pemilik_rekening')->nullable();

            // Informasi BPJS
            $table->string('no_bpjs_kesehatan')->nullable();
            $table->string('no_bpjs_ketenagakerjaan')->nullable();
            $table->string('no_npwp')->nullable();

            // Informasi Sistem
            $table->boolean('is_active')->default(true);
            $table->string('role')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('unit_kerja')->nullOnDelete();
            $table->string('kode', 30)->unique();
            $table->string('nama', 200);
            $table->string('tipe', 20);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('ref_golongan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('golongan_utama', 10);
            $table->string('pangkat', 100);
            $table->foreignId('kelompok_biaya_id')->nullable(); // Relasi SBM nanti
            $table->smallInteger('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique();
            $table->string('nama', 200);
            $table->string('gelar_depan', 50)->nullable();
            $table->string('gelar_belakang', 100)->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('unit_kerja')->nullOnDelete();
            $table->foreignId('golongan_id')->nullable()->constrained('ref_golongan')->nullOnDelete();
            $table->string('jabatan', 200)->nullable();
            $table->string('eselon', 10)->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('ref_golongan');
        Schema::dropIfExists('unit_kerja');
    }
};
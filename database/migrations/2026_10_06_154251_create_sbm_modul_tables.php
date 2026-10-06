<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Wilayah (Provinsi/Kota)
        Schema::create('ref_wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('tipe', 10); // provinsi / kota
            $table->string('nama', 150);
            $table->foreignId('provinsi_id')->nullable()->constrained('ref_wilayah')->nullOnDelete();
            $table->boolean('is_luar_negeri')->default(false);
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // 2. Periode Peraturan SBM
        Schema::create('sbm_periode', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tahun');
            $table->string('no_peraturan', 150);
            $table->date('berlaku_mulai');
            $table->date('berlaku_sampai')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // 3. Kategori SBM
        Schema::create('sbm_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 60)->unique();
            $table->string('nama', 150);
            $table->string('cakupan', 20)->default('perjalanan_dinas');
            $table->boolean('is_luar_negeri')->default(false);
            $table->boolean('is_aktif')->default(true);
        });

        // 4. Komponen SBM
        Schema::create('sbm_komponen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('sbm_kategori')->cascadeOnDelete();
            $table->string('kode', 60);
            $table->string('nama', 150);
            $table->string('satuan', 20); // OH, Malam, dll
            $table->boolean('is_aktif')->default(true);
        });

        // 5. Tingkat SBM
        Schema::create('sbm_tingkat', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 60)->unique();
            $table->string('nama', 150);
            $table->string('jenis', 15);
        });

        // 6. Tarif SBM
        Schema::create('sbm_tarif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('sbm_periode')->cascadeOnDelete();
            $table->foreignId('komponen_id')->constrained('sbm_komponen')->cascadeOnDelete();
            $table->foreignId('tingkat_id')->constrained('sbm_tingkat')->cascadeOnDelete();
            $table->foreignId('wilayah_id')->nullable()->constrained('ref_wilayah')->nullOnDelete();
            $table->foreignId('asal_id')->nullable()->constrained('ref_wilayah')->nullOnDelete();
            $table->foreignId('tujuan_id')->nullable()->constrained('ref_wilayah')->nullOnDelete();
            $table->decimal('nominal', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sbm_tarif');
        Schema::dropIfExists('sbm_tingkat');
        Schema::dropIfExists('sbm_komponen');
        Schema::dropIfExists('sbm_kategori');
        Schema::dropIfExists('sbm_periode');
        Schema::dropIfExists('ref_wilayah');
    }
};
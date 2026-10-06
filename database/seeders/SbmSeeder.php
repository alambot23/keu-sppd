<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SbmSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Periode SBM
        $periodeId = DB::table('sbm_periode')->insertGetId([
            'tahun' => 2025,
            'no_peraturan' => 'PMK Nomor 32 Tahun 2025',
            'berlaku_mulai' => '2025-01-01',
            'is_aktif' => 1,
            'created_at' => $now,
        ]);

        // 2. Kategori
        $katUangHarian = DB::table('sbm_kategori')->insertGetId([
            'kode' => 'UANG_HARIAN_DN',
            'nama' => 'Uang Harian Perjalanan Dinas Dalam Negeri',
            'cakupan' => 'perjalanan_dinas',
            'is_aktif' => 1,
        ]);

        $katPenginapan = DB::table('sbm_kategori')->insertGetId([
            'kode' => 'PENGINAPAN',
            'nama' => 'Biaya Penginapan',
            'cakupan' => 'perjalanan_dinas',
            'is_aktif' => 1,
        ]);

        // 3. Komponen
        $kompLuarKota = DB::table('sbm_komponen')->insertGetId([
            'kategori_id' => $katUangHarian,
            'kode' => 'LUAR_KOTA',
            'nama' => 'Uang Harian Luar Kota',
            'satuan' => 'OH',
            'is_aktif' => 1,
        ]);

        $kompHotel = DB::table('sbm_komponen')->insertGetId([
            'kategori_id' => $katPenginapan,
            'kode' => 'HOTEL',
            'nama' => 'Tarif Hotel Maksimal',
            'satuan' => 'Malam',
            'is_aktif' => 1,
        ]);

        // 4. Tingkat
        $tingkatSemua = DB::table('sbm_tingkat')->insertGetId([
            'kode' => 'SEMUA', 'nama' => 'Berlaku Untuk Semua', 'jenis' => 'semua'
        ]);

        // 5. Wilayah (ACEH)
        $wilayahAcehId = DB::table('ref_wilayah')->insertGetId([
            'tipe' => 'provinsi',
            'nama' => 'ACEH',
            'is_aktif' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 6. Tarif SBM
        DB::table('sbm_tarif')->insert([
            [
                'periode_id' => $periodeId,
                'komponen_id' => $kompLuarKota,
                'tingkat_id' => $tingkatSemua,
                'wilayah_id' => $wilayahAcehId,
                'asal_id' => null,
                'tujuan_id' => null,
                'nominal' => 360000.00,
                'created_at' => $now,
            ],
            [
                'periode_id' => $periodeId,
                'komponen_id' => $kompHotel,
                'tingkat_id' => $tingkatSemua,
                'wilayah_id' => $wilayahAcehId,
                'asal_id' => null,
                'tujuan_id' => null,
                'nominal' => 770000.00,
                'created_at' => $now,
            ]
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. SEED UNIT KERJA (Fakultas & Universitas)
        $unitId = DB::table('unit_kerja')->insertGetId([
            'kode'       => 'UNIMAL',
            'nama'       => 'Universitas Malikussaleh',
            'tipe'       => 'rektorat',
            'is_aktif'   => 1, // MySQL boolean (1 = true)
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. SEED REFERENSI GOLONGAN
        $golonganData = [
            ['kode' => 'IV/e', 'golongan_utama' => 'IV', 'pangkat' => 'Pembina Utama', 'urutan' => 1],
            ['kode' => 'IV/d', 'golongan_utama' => 'IV', 'pangkat' => 'Pembina Utama Madya', 'urutan' => 2],
            ['kode' => 'IV/c', 'golongan_utama' => 'IV', 'pangkat' => 'Pembina Utama Muda', 'urutan' => 3],
            ['kode' => 'IV/b', 'golongan_utama' => 'IV', 'pangkat' => 'Pembina Tingkat I', 'urutan' => 4],
            ['kode' => 'IV/a', 'golongan_utama' => 'IV', 'pangkat' => 'Pembina', 'urutan' => 5],
            ['kode' => 'III/d', 'golongan_utama' => 'III', 'pangkat' => 'Penata Tingkat I', 'urutan' => 6],
            ['kode' => 'III/c', 'golongan_utama' => 'III', 'pangkat' => 'Penata', 'urutan' => 7],
            ['kode' => 'III/b', 'golongan_utama' => 'III', 'pangkat' => 'Penata Muda Tingkat I', 'urutan' => 8],
            ['kode' => 'III/a', 'golongan_utama' => 'III', 'pangkat' => 'Penata Muda', 'urutan' => 9],
            ['kode' => 'II/d', 'golongan_utama' => 'II', 'pangkat' => 'Pengatur Tingkat I', 'urutan' => 10],
            ['kode' => 'II/c', 'golongan_utama' => 'II', 'pangkat' => 'Pengatur', 'urutan' => 11],
            ['kode' => 'II/b', 'golongan_utama' => 'II', 'pangkat' => 'Pengatur Muda Tingkat I', 'urutan' => 12],
            ['kode' => 'XI', 'golongan_utama' => 'PPPK', 'pangkat' => 'PPPK Golongan XI', 'urutan' => 13],
            ['kode' => 'XII', 'golongan_utama' => 'PPPK', 'pangkat' => 'PPPK Golongan XII', 'urutan' => 14],
        ];
        
        DB::table('ref_golongan')->insert($golonganData);

        $golIvaId = DB::table('ref_golongan')->where('kode', 'IV/a')->value('id');

        // 3. SEED PEGAWAI (Sampel)
        $pegawaiData = [
            [
                'nip' => '196312312001121003',
                'gelar_depan' => 'Dr.',
                'nama' => 'Syamsul Bahri',
                'gelar_belakang' => 'S.E., M.M',
                'unit_id' => $unitId,
                'golongan_id' => $golIvaId,
                'jabatan' => 'Lektor Kepala',
                'is_aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '198006172009042002',
                'gelar_depan' => null,
                'nama' => 'Sri Rahayu Retnowulan',
                'gelar_belakang' => 'S.Pd., M.Pd.',
                'unit_id' => $unitId,
                'golongan_id' => $golIvaId,
                'jabatan' => 'Asisten Ahli',
                'is_aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '197512252002122003',
                'gelar_depan' => 'Dr.',
                'nama' => 'Cut Asmaul Husna TR',
                'gelar_belakang' => 'S.H., M.Kn',
                'unit_id' => $unitId,
                'golongan_id' => $golIvaId,
                'jabatan' => 'Lektor Kepala',
                'is_aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nip' => '197703062005011002', // Pak Bustami (Pejabat SPPD)
                'gelar_depan' => null,
                'nama' => 'Bustami',
                'gelar_belakang' => 'S.Si., M.Si., M.Kom',
                'unit_id' => $unitId,
                'golongan_id' => DB::table('ref_golongan')->where('kode', 'IV/c')->value('id'),
                'jabatan' => 'Pejabat Pembuat Komitmen',
                'is_aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('pegawai')->insert($pegawaiData);
    }
}
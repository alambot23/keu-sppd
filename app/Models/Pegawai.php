<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\UnitKerja;
use App\Models\RefGolongan;


class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $guarded = ['id'];

    // Relasi ke Unit Kerja
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class, 'unit_id');
    }

    // Relasi ke Golongan
    public function golongan(): BelongsTo
    {
        return $this->belongsTo(RefGolongan::class, 'golongan_id');
    }

    // Accessor Virtual untuk Nama Lengkap Beserta Gelar
    public function getNamaLengkapAttribute(): string
    {
        $depan = $this->gelar_depan ? $this->gelar_depan . ' ' : '';
        $belakang = $this->gelar_belakang ? ', ' . $this->gelar_belakang : '';
        
        return $depan . $this->nama . $belakang;
    }
}
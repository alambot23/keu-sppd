<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnitKerja extends Model
{
    protected $table = 'unit_kerja';
    protected $guarded = ['id'];

    // Relasi ke Unit Kerja Induk (jika ada sub-unit)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class, 'parent_id');
    }

    // Relasi ke Sub-unit di bawahnya
    public function children(): HasMany
    {
        return $this->hasMany(UnitKerja::class, 'parent_id');
    }

    // Relasi ke Pegawai di unit ini
    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'unit_id');
    }
}
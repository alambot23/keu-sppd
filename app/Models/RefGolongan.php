<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefGolongan extends Model
{
    protected $table = 'ref_golongan';
    protected $guarded = ['id'];

    // Accessor untuk dropdown Filament (Misal: "IV/a - Pembina")
    public function getKodePangkatAttribute(): string
    {
        return $this->kode . ' - ' . $this->pangkat;
    }
}
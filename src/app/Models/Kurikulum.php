<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kurikulum extends Model
{
    protected $guarded = ['id'];

    public function strukturKurikulums(): HasMany
    {
        return $this->hasMany(StrukturKurikulum::class);
    }

    public function capaianPembelajarans(): HasMany
    {
        return $this->hasMany(CapaianPembelajaran::class);
    }

    public function getNamaLengkapAttribute(): string
    {
        return "{$this->nama} – {$this->jenjang} Fase {$this->fase}";
    }
}
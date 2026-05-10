<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlurTujuanPembelajaran extends Model
{
    protected $guarded = ['id'];

    public function capaianPembelajaran(): BelongsTo
    {
        return $this->belongsTo(CapaianPembelajaran::class);
    }

    public function tujuanPembelajarans(): HasMany
    {
        return $this->hasMany(TujuanPembelajaran::class);
    }
}
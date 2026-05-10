<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CapaianPembelajaran extends Model
{
    protected $guarded = ['id'];

    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function alurTujuanPembelajarans(): HasMany
    {
        return $this->hasMany(AlurTujuanPembelajaran::class);
    }
}
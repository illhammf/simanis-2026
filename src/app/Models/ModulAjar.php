<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModulAjar extends Model
{
    protected $guarded = ['id'];

    public function tujuanPembelajaran(): BelongsTo
    {
        return $this->belongsTo(TujuanPembelajaran::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
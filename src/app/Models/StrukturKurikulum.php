<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturKurikulum extends Model
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
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TujuanPembelajaran extends Model
{
    protected $guarded = ['id'];

    public function alurTujuanPembelajaran(): BelongsTo
    {
        return $this->belongsTo(AlurTujuanPembelajaran::class);
    }

    public function modulAjars(): HasMany
    {
        return $this->hasMany(ModulAjar::class);
    }
}
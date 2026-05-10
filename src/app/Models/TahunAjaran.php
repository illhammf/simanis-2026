<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_aktif'        => 'boolean',
    ];

    protected static function booted(): void
    {
        // Saat satu tahun ajaran diset aktif, nonaktifkan semua yang lain
        static::saving(function (self $model) {
            if ($model->is_aktif && $model->isDirty('is_aktif')) {
                static::where('id', '!=', $model->id)
                    ->where('is_aktif', true)
                    ->update(['is_aktif' => false]);
            }
        });
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function jadwalPelajarans(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function getLabelAttribute(): string
    {
        return "{$this->nama} - {$this->semester}";
    }
}

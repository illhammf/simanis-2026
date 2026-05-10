<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tugas extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'deadline'      => 'date',
    ];

    public static array $tipeLabels = [
        'tugas_harian'  => 'Tugas Harian',
        'pr'            => 'PR (Pekerjaan Rumah)',
        'kuis'          => 'Kuis',
        'ulangan_harian'=> 'Ulangan Harian',
        'pts'           => 'PTS (Penilaian Tengah Semester)',
        'pas'           => 'PAS (Penilaian Akhir Semester)',
        'proyek'        => 'Proyek',
    ];

    public function modulAjar(): BelongsTo
    {
        return $this->belongsTo(ModulAjar::class);
    }

    public function getTipeLabelAttribute(): string
    {
        return static::$tipeLabels[$this->tipe] ?? $this->tipe;
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }
}
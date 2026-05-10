<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StreamMilestone extends Model
{
    protected $table = 'stream_milestones';

    protected $guarded = ['id'];

    protected $casts = [
        'semester' => 'integer',
        'is_aktif' => 'boolean',
    ];

    public static array $semesterLabels = [
        1 => 'Semester 1',
        2 => 'Semester 2',
        3 => 'Semester 3',
        4 => 'Semester 4',
        5 => 'Semester 5',
        6 => 'Semester 6',
    ];

    public static array $tahunLabels = [
        1 => 'Tahun 1 — Semester 1 (Ganjil)',
        2 => 'Tahun 1 — Semester 2 (Genap)',
        3 => 'Tahun 2 — Semester 3 (Ganjil)',
        4 => 'Tahun 2 — Semester 4 (Genap)',
        5 => 'Tahun 3 — Semester 5 (Ganjil)',
        6 => 'Tahun 3 — Semester 6 (Genap)',
    ];

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    /** Kompetensi akademik sebagai array baris */
    public function getKompetensiListAttribute(): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", $this->kompetensi_akademik ?? ''))
        ));
    }

    /** Target karakter sebagai array baris */
    public function getTargetListAttribute(): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", $this->target_karakter ?? ''))
        ));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = 'absensis';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public static array $statusOptions = [
        'hadir' => 'Hadir',
        'izin'  => 'Izin',
        'sakit' => 'Sakit',
        'alpha' => 'Alpha',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function jadwalPelajaran(): BelongsTo
    {
        return $this->belongsTo(JadwalPelajaran::class);
    }
}
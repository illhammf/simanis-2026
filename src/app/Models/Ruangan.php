<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    protected $guarded = ['id'];

    public static array $jenisLabels = [
        'kelas'        => 'Ruang Kelas',
        'lab_ipa'      => 'Laboratorium IPA',
        'lab_komputer' => 'Laboratorium Komputer',
        'lab_bahasa'   => 'Laboratorium Bahasa',
        'aula'         => 'Aula',
        'perpustakaan' => 'Perpustakaan',
        'lapangan'     => 'Lapangan',
        'lainnya'      => 'Lainnya',
    ];

    public function jadwalPelajarans(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function getJenisLabelAttribute(): string
    {
        return static::$jenisLabels[$this->jenis] ?? $this->jenis;
    }
}
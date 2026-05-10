<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model
{
    protected $table = 'hari_liburs';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal'  => 'date',
        'is_aktif' => 'boolean',
    ];

    public static array $jenisOptions = [
        'nasional' => 'Nasional',
        'lokal'    => 'Lokal / Daerah',
        'sekolah'  => 'Kegiatan Sekolah',
    ];
}
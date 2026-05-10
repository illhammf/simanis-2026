<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'nss',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'kepala_sekolah',
        'akreditasi',
        'tahun_berdiri',
        'logo',
        'visi',
        'misi',
        'tujuan',
        'sasaran',
    ];

    public static function getInstance(): static
    {
        return static::firstOrCreate(['id' => 1], [
            'nama_sekolah' => 'Nama Sekolah',
        ]);
    }
}
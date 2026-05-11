<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_periksa',
        'keluhan',
        'status',
    ];

    // Relasi:
    // Pemeriksaan ini dimiliki oleh satu pasien
    // belongsTo menuju model Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi:
    // Pemeriksaan ini ditangani oleh satu dokter
    // belongsTo menuju model Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
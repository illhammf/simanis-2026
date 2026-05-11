<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];

    // Relasi:
    // Satu pasien bisa memiliki banyak pemeriksaan
    // hasMany menuju model Pemeriksaan
    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
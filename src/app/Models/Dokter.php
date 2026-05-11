<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'nama',
        'spesialis',
        'no_hp',
        'email',
    ];

    // Relasi:
    // Satu dokter bisa menangani banyak pemeriksaan
    // hasMany menuju model Pemeriksaan
    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
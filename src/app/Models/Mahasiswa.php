<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'alamat',
        'no_hp',
    ];

    // Relasi:
    // Satu mahasiswa bisa memiliki banyak peminjaman
    // hasMany menuju model Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
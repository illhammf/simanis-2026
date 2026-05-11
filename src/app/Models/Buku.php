<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
    ];

    // Relasi:
    // Satu buku bisa dipinjam berkali-kali
    // hasMany menuju model Peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
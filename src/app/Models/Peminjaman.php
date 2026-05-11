<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'mahasiswa_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi:
    // Peminjaman ini milik satu mahasiswa
    // belongsTo menuju model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi:
    // Peminjaman ini untuk satu buku
    // belongsTo menuju model Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
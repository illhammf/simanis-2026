<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'stok',
    ];

    // satu produk bisa memiliki banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
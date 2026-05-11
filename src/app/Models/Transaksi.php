<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'produk_id',
        'pelanggan_id',
        'tanggal_transaksi',
        'jumlah',
        'total_harga',
        'status',
    ];

    // transaksi ini milik satu produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // transaksi ini milik satu pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
    ];

    // satu pelanggan bisa memiliki banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Konsultasi extends Model
{
    protected $table = 'konsultasis';

    protected $guarded = ['id'];

    protected $casts = [
        'dibalas_at' => 'datetime',
    ];

    public static array $statusOptions = [
        'pending' => 'Menunggu',
        'dibaca'  => 'Dibaca',
        'dibalas' => 'Dibalas',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
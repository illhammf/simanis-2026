<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    protected static function booted(): void
    {
        // Saat plotting: otomatis isi users.username dengan NIS
        static::updated(function (self $student) {
            if ($student->isDirty('user_id') && $student->user_id) {
                User::where('id', $student->user_id)
                    ->update(['username' => $student->nis]);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    public function ortu(): BelongsTo
    {
        return $this->belongsTo(Ortu::class, 'id', 'student_id');
    }

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }

    public function konsultasis(): HasMany
    {
        return $this->hasMany(Konsultasi::class);
    }
}

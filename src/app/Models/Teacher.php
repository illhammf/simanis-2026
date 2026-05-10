<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $guarded = ['id'];

     protected static function booted(): void
    {
        // Saat plotting: otomatis isi users.username dengan NIG
        static::updated(function (self $teacher) {
            if ($teacher->isDirty('user_id') && $teacher->user_id) {
                User::where('id', $teacher->user_id)
                    ->update(['username' => $teacher->nig]);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function jadwalPelajarans(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function modulAjars(): HasMany
    {
        return $this->hasMany(ModulAjar::class);
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

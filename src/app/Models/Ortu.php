<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ortu extends Model
{
    //
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        // Saat plotting: otomatis isi users.username dengan NIO
        static::updated(function (self $ortu) {
            if ($ortu->isDirty('user_id') && $ortu->user_id) {
                User::where('id', $ortu->user_id)
                    ->update(['username' => $ortu->nio]);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AkademikStaff extends Model
{
    protected $table = 'akademik_staffs';
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        // Saat plotting: otomatis isi users.username dengan NIA
        static::updated(function (self $staff) {
            if ($staff->isDirty('user_id') && $staff->user_id) {
                User::where('id', $staff->user_id)
                    ->update(['username' => $staff->nia]);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
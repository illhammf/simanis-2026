<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stream extends Model
{
    protected $guarded = ['id'];

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function mataPelajarans(): HasMany
    {
        return $this->hasMany(MataPelajaran::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(StreamMilestone::class)->orderBy('semester');
    }
}
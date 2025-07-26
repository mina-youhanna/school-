<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SundayClass extends Model
{
    protected $table = 'sunday_classes';

    protected $fillable = [
        'name',
        'saint_image',
        'stage',
        'schedule',
        'place',
        'servants',
        'registered_count'
    ];

    protected $casts = [
        'servants' => 'array'
    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function curriculum(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }
} 
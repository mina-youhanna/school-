<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curriculum extends Model
{
    protected $fillable = [
        'class_id',
        'title',
        'content',
        'lesson_date',
        'lesson_number'
    ];

    protected $casts = [
        'lesson_date' => 'date'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SundayClass::class, 'class_id');
    }
}

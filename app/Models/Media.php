<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = [
        'class_id',
        'type',
        'file_path',
        'title',
        'description'
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SundayClass::class, 'class_id');
    }
} 
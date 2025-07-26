<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReading extends Model
{
    protected $fillable = [
        'date',
        'coptic_date',
        'title',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'date' => 'date',
    ];
}

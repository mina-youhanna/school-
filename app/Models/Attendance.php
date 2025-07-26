<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'class_id',
        'student_id',
        'date',
        'is_present',
        'notes'
    ];
    
    protected $casts = [
        'date' => 'date',
        'is_present' => 'boolean'
    ];
    
    public function class(): BelongsTo
    {
        return $this->belongsTo(SundayClass::class, 'class_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    
    protected $table = 'attendance'; // Specify the correct table name
    
    protected $fillable = [
        'class_id',
        'student_id',
        'date',
        'is_present',
        'tasbeha',
        'mass',
        'class_attendance',
        'church_education',
        'notes'
    ];
    
    protected $casts = [
        'date' => 'date',
        'is_present' => 'boolean',
        'tasbeha' => 'boolean',
        'mass' => 'boolean',
        'class_attendance' => 'boolean',
        'church_education' => 'boolean'
    ];
    
    public function class(): BelongsTo
    {
        return $this->belongsTo(StudyClass::class, 'class_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
} 
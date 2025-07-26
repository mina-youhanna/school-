<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'subject_id', 'class_id', 'title', 'display_mode', 'total_time',
        'start_time', 'end_time', 'image'
    ];
    
    protected $casts = [
        'exam_date' => 'date'
    ];
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class, 'class_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
} 
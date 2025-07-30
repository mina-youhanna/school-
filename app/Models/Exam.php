<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_type',
        'subject_id',
        'class_id',
        'stage',
        'title',
        'display_mode',
        'total_time',
        'start_time',
        'end_time',
        'image'
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

    public function studyClasses()
    {
        return $this->hasMany(StudyClass::class, 'stage', 'stage');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }

    // Getter method for stage - if stage is not set, get it from the related study class
    public function getStageAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // If stage is not set, try to get it from the related study class
        if ($this->studyClass) {
            return $this->studyClass->stage;
        }

        return null;
    }

    // Setter method for stage
    public function setStageAttribute($value)
    {
        $this->attributes['stage'] = $value;
    }
}

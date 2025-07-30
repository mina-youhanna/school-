<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnhancedExam extends Model
{
    use HasFactory;

    protected $table = 'enhanced_exams';

    protected $fillable = [
        'user_id',
        'class_id',
        'subject_name',
        'exam_date',
        'score',
        'max_score',
        'notes'
    ];

    protected $casts = [
        'exam_date' => 'date',
        'score' => 'decimal:2',
        'max_score' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(StudyClass::class, 'class_id');
    }

    // Scope للبحث بالتاريخ
    public function scopeByDate($query, $date)
    {
        return $query->where('exam_date', $date);
    }

    // Scope للبحث بنطاق تاريخ
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('exam_date', [$startDate, $endDate]);
    }

    // Scope للبحث بالطالب
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope للبحث بالفصل
    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    // Scope للبحث بالمادة
    public function scopeBySubject($query, $subjectName)
    {
        return $query->where('subject_name', $subjectName);
    }

    // حساب النسبة المئوية
    public function getPercentageAttribute()
    {
        if ($this->max_score > 0) {
            return round(($this->score / $this->max_score) * 100, 2);
        }
        return 0;
    }

    // الحصول على التقييم
    public function getEvaluationAttribute()
    {
        $percentage = $this->percentage;

        if ($percentage >= 90) {
            return 'ممتاز';
        } elseif ($percentage >= 80) {
            return 'جيد جداً';
        } elseif ($percentage >= 70) {
            return 'جيد';
        } elseif ($percentage >= 60) {
            return 'مقبول';
        } else {
            return 'راسب';
        }
    }
}

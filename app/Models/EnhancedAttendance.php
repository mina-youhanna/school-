<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnhancedAttendance extends Model
{
    use HasFactory;

    protected $table = 'enhanced_attendance';

    protected $fillable = [
        'user_id',
        'class_id',
        'date',
        'is_present',
        'mass',
        'tasbeha',
        'class_attendance',
        'church_education',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'is_present' => 'boolean',
        'mass' => 'boolean',
        'tasbeha' => 'boolean',
        'class_attendance' => 'boolean',
        'church_education' => 'boolean'
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
        return $query->where('date', $date);
    }

    // Scope للبحث بنطاق تاريخ
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
    use HasFactory;

    protected $table = 'study_classes';

    protected $fillable = [
        'name', 'stage', 'schedule', 'place', 'main_servant_email',
        'assistant_servants_emails', 'saint_image', 'students_count', 'gender'
    ];

    public function students()
    {
        return $this->hasMany(User::class, 'my_class_id');
    }

    public function servants()
    {
        return $this->belongsToMany(User::class, 'user_serving_study_classes', 'class_id', 'user_id');
    }

    public function mainServant()
    {
        return $this->belongsTo(User::class, 'main_servant_email', 'email');
    }

    public function allServants()
    {
        // الحصول على جميع الخدام (الرئيسي + المساعدين)
        $mainServant = $this->mainServant;
        $assistantServants = $this->servants;
        
        $allServants = collect();
        
        if ($mainServant) {
            $allServants->push($mainServant);
        }
        
        if ($assistantServants) {
            $allServants = $allServants->merge($assistantServants);
        }
        
        return $allServants->unique('id');
    }

    public function getTotalServantsCount()
    {
        $mainServantCount = $this->main_servant_email ? 1 : 0;
        $assistantServantsCount = $this->servants()->count();
        
        return $mainServantCount + $assistantServantsCount;
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'class_id');
    }
} 
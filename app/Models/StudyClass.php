<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
    use HasFactory;

    protected $table = 'study_classes';

    protected $fillable = [
        'name',
        'stage',
        'schedule',
        'place',
        'saint_image',
        'gender',
    ];

    public function students()
    {
        return $this->hasMany(User::class, 'my_class_id');
    }

    public function servants()
    {
        return $this->belongsToMany(User::class, 'user_serving_classes', 'class_id', 'user_id');
    }
} 
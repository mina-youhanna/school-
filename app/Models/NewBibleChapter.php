<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewBibleChapter extends Model
{
    protected $table = 'new_bible_chapters'; // لو اسم الجدول مختلف عن اسم الموديل بالجمع
    // لو عندك primary key غير id أضف:
    // protected $primaryKey = 'اسم_العمود';
    // لو لا تريد timestamps:
    // public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seneksar extends Model
{
    protected $table = 'seneksar';
    public $timestamps = false; // إذا لم يكن لديك created_at و updated_at
    // إذا كان لديك primary key غير id أضف:
    // protected $primaryKey = 'id';
}

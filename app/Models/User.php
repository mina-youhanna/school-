<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone',
        'whatsapp',
        'relative_phone',
        'address',
        'confession_father',
        'dob',
        'gender',
        'role',
        'is_deacon',
        'ordination_date',
        'ordination_bishop',
        'deacon_rank',
        'my_class_id',
        'profile_image',
        'is_admin',
        'code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_deacon' => 'boolean',
            'dob' => 'date',
            'ordination_date' => 'date',
            'is_admin' => 'boolean'
        ];
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? Storage::url($this->profile_image) : null;
    }

    public function myClass()
    {
        return $this->belongsTo(StudyClass::class, 'my_class_id');
    }

    public function servingClasses()
    {
        return $this->belongsToMany(StudyClass::class, 'user_serving_classes', 'user_id', 'class_id');
    }
}

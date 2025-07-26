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
        'is_main_servant',
        'serving_classes',
        'is_deacon',
        'ordination_date',
        'ordination_bishop',
        'deacon_rank',
        'code',
        'profile_image',
        'score',
        'is_admin'
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
            'serving_classes' => 'array',
            'dob' => 'date',
            'ordination_date' => 'date',
            'is_deacon' => 'boolean',
            'is_admin' => 'boolean',
            'is_main_servant' => 'boolean',
            'score' => 'integer'
        ];
    }

    public function hasRole($role)
    {
        // افترض أن لديك عمود 'role' في جدول المستخدمين
        // أو علاقة للأدوار
        return $this->role === $role;
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? Storage::url($this->profile_image) : null;
    }

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class, 'my_class_id');
    }

    public function servingClasses()
    {
        return $this->belongsToMany(SundayClass::class, 'user_serving_classes', 'user_id', 'class_id');
    }

    public function deaconPromotions()
    {
        return $this->hasMany(DeaconPromotion::class);
    }

    public function getLatestPromotionAttribute()
    {
        return $this->deaconPromotions()->latest()->first();
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function examGrades()
    {
        return $this->hasMany(ExamGrade::class);
    }

    public function servingActivities()
    {
        return $this->hasMany(ServingActivity::class);
    }

    public function completedCourses()
    {
        return $this->hasMany(CompletedCourse::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isServant()
    {
        return $this->role === 'خادم';
    }

    public function isStudent()
    {
        return $this->role === 'مخدوم';
    }

    /**
     * Get the user's subscriptions.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the user's active subscription.
     */
    public function activeSubscription()
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->where('expiry_date', '>', now())
            ->latest()
            ->first();
    }

    /**
     * Check if user has active subscription.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription() !== null;
    }

    /**
     * Check if subscription is expiring soon (within 30 days)
     */
    public function isSubscriptionExpiringSoon(): bool
    {
        $activeSubscription = $this->activeSubscription();
        if (!$activeSubscription) {
            return false;
        }
        
        return $activeSubscription->expiry_date->diffInDays(now()) <= 30;
    }

    /**
     * Get days until subscription expires
     */
    public function getDaysUntilSubscriptionExpires(): ?int
    {
        $activeSubscription = $this->activeSubscription();
        if (!$activeSubscription) {
            return null;
        }
        
        return $activeSubscription->expiry_date->diffInDays(now());
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
}

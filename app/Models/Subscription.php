<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'subscription_date',
        'expiry_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'subscription_date' => 'date',
        'expiry_date' => 'date',
        'amount' => 'decimal:2'
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if subscription is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expiry_date->isFuture();
    }

    /**
     * Check if subscription is expired
     */
    public function isExpired(): bool
    {
        return $this->expiry_date->isPast();
    }

    /**
     * Calculate expiry date based on subscription date (11/9 of each year)
     */
    public static function calculateExpiryDate($subscriptionDate)
    {
        $date = Carbon::parse($subscriptionDate);
        $currentYear = $date->year;
        
        // If subscription date is after 11/9, expiry will be 11/9 of next year
        if ($date->month > 9 || ($date->month == 9 && $date->day > 11)) {
            return Carbon::create($currentYear + 1, 9, 11);
        } else {
            return Carbon::create($currentYear, 9, 11);
        }
    }

    /**
     * Get formatted expiry date
     */
    public function getFormattedExpiryDateAttribute()
    {
        return $this->expiry_date->format('d/m/Y');
    }

    /**
     * Get formatted subscription date
     */
    public function getFormattedSubscriptionDateAttribute()
    {
        return $this->subscription_date->format('d/m/Y');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeaconPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_rank',
        'to_rank',
        'promotion_date',
        'promoted_by',
        'notes'
    ];

    protected $casts = [
        'promotion_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 
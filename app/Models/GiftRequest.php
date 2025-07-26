<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftRequest extends Model
{
    protected $fillable = [
        'user_id', 'gift_id', 'quantity', 'status', 'class_id', 'handled_by', 'handled_at'
    ];

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}

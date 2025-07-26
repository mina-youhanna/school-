<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = ['name', 'image', 'points', 'quantity'];

    public function giftRequests()
    {
        return $this->hasMany(GiftRequest::class);
    }
}

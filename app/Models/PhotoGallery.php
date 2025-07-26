<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'folder_name',
        'created_by',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class, 'gallery_id');
    }

    public function coverPhoto()
    {
        return $this->hasOne(GalleryPhoto::class, 'gallery_id')->oldest();
    }

    public function getPhotosCountAttribute()
    {
        return $this->photos()->count();
    }

    public function getCoverPhotoAttribute()
    {
        return $this->photos()->first();
    }
} 
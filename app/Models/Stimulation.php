<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stimulation extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'age_range',
        'materials',
        'instructions',
        'benefits',
        'duration',
        'image',
        'visio',
        'likes'
    ];

    // Relasi dengan users yang like stimulasi ini
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'stimulation_user_likes')->withTimestamps();
    }

    // Check if user has liked this stimulation
    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

    // Get total likes
    public function getLikesAttribute()
    {
        return $this->likedByUsers()->count();
    }
}

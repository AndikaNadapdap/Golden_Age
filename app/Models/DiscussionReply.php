<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
        'content',
        'likes',
        'is_best_answer',
    ];

    protected $casts = [
        'is_best_answer' => 'boolean',
    ];

    // Relasi dengan Discussion
    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    // Relasi dengan User
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan users yang like reply ini
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'discussion_reply_user_likes')->withTimestamps();
    }

    // Check if user has liked this reply
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

    // Increment likes
    public function incrementLikes()
    {
        $this->increment('likes');
    }
}

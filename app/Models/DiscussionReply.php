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

    // Increment likes
    public function incrementLikes()
    {
        $this->increment('likes');
    }
}

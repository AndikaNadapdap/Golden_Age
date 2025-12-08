<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'user_id',
        'views',
        'likes',
        'replies_count',
        'is_closed',
        'is_pinned',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'is_pinned' => 'boolean',
    ];

    // Relasi dengan User
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan Replies
    public function replies()
    {
        return $this->hasMany(DiscussionReply::class)->latest();
    }

    // Scope untuk filter category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk diskusi yang tidak ditutup
    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    // Scope untuk diskusi yang di-pin
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }

    // Increment likes
    public function incrementLikes()
    {
        $this->increment('likes');
    }

    // Increment replies count
    public function incrementRepliesCount()
    {
        $this->increment('replies_count');
    }

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($discussion) {
            if (empty($discussion->slug)) {
                $discussion->slug = Str::slug($discussion->title);
            }
<<<<<<< HEAD
        });
=======
        }); 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
    }
}

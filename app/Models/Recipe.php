<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'ingredients',
        'instructions',
        'age_range',
        'category',
        'cooking_time',
        'servings',
        'difficulty',
        'image',
        'user_id',
        'is_published',
        'published_at',
        'views',
        'likes'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi dengan User
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan users yang like resep ini
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'recipe_user_likes')->withTimestamps();
    }

    // Check if user has liked this recipe
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

    // Auto generate slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {
            if (empty($recipe->slug)) {
                $recipe->slug = Str::slug($recipe->title);
            }
        });
    }

    // Scope untuk resep published
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Scope filter by age range
    public function scopeByAgeRange($query, $ageRange)
    {
        return $query->where('age_range', $ageRange);
    }

    // Scope filter by category
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
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

    // Get ingredients as array
    public function getIngredientsArrayAttribute()
    {
        return explode("\n", $this->ingredients);
    }

    // Get instructions as array
    public function getInstructionsArrayAttribute()
    {
        return explode("\n", $this->instructions);
    }
}

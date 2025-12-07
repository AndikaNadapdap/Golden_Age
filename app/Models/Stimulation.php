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
        'likes'
    ];
}

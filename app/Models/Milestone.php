<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'category',
        'age_range',
        'min_age_months',
        'max_age_months',
        'title',
        'description',
        'tips'
    ];

    public function childProgress()
    {
        return $this->hasMany(ChildProgress::class);
    }
}

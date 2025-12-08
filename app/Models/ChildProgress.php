<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildProgress extends Model
{
    protected $fillable = [
        'user_id',
        'milestone_id',
        'is_achieved',
        'achieved_date',
        'notes'
    ];

    protected $casts = [
        'is_achieved' => 'boolean',
        'achieved_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }
}

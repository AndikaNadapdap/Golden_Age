<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'str_number',
        'specialization',
        'hospital_name',
        'phone_number',
        'years_of_experience',
        'bio',
    ];

    // Relasi ke user (dokter)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

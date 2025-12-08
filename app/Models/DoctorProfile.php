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
<<<<<<< HEAD
=======
 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9

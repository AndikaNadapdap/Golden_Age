<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Child extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'gender',
        'birth_weight',
        'birth_height',
        'blood_type',
        'notes',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relasi ke user (orang tua)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hitung usia anak
    public function getAgeAttribute()
    {
        if (!$this->birth_date) return null;
        
        $now = Carbon::now();
        $birth = Carbon::parse($this->birth_date);
        
        $years = $birth->diffInYears($now);
        $months = $birth->copy()->addYears($years)->diffInMonths($now);
        
        if ($years > 0) {
            return $years . ' tahun ' . $months . ' bulan';
        }
        
        return $months . ' bulan';
    }

    // Hitung usia dalam bulan (untuk tracking milestone)
    public function getAgeInMonthsAttribute()
    {
        if (!$this->birth_date) return 0;
        return Carbon::parse($this->birth_date)->diffInMonths(Carbon::now());
    }
}

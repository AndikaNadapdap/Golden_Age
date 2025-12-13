<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'google_id',
        'facebook_id',
        'avatar',
        'phone',
    ];

    // Kolom yang disembunyikan saat model di-serialize
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke children (untuk orang tua)
    public function children()
    {
        return $this->hasMany(Child::class);
    }

    // Relasi ke doctor profile (untuk dokter)
    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class);
    }

    // Helper method untuk cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper method untuk cek apakah user adalah dokter
    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    // Helper method untuk cek apakah user adalah orang tua
    public function isParent()
    {
        return $this->role === 'parent';
    }
}

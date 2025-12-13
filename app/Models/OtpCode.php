<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $fillable = [
        'identifier', 'channel', 'otp_hash', 'expires_at', 'used_at', 'attempts'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }

    public function isUsed(): bool
    {
        return $this->used_at !== null;
    }
}

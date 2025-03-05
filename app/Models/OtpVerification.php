<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'email',
        'mobile',
        'otp_code',
        'verification_type',
        'expires_at',
        'attempts'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Scopes
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }

    public function scopeForEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeForMobile($query, $mobile)
    {
        return $query->where('mobile', $mobile);
    }

    // Methods
    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public function incrementAttempts()
    {
        $this->increment('attempts');
    }

    public function markAsUsed()
    {
        $this->update(['expires_at' => now()]);
    }
}

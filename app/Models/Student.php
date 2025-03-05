<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function profiles()
    {
        return $this->hasMany(StudentProfile::class);
    }

    public function currentProfile()
    {
        return $this->hasOne(StudentProfile::class)->where('is_current', true);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Add other relationships..


    public function otpVerifications()
    {
        return $this->hasMany(OtpVerification::class);
    }

    public function generateEmailOtp()
    {
        return $this->otpVerifications()->create([
            'email' => $this->email,
            'otp_code' => $this->generateOtpCode(),
            'verification_type' => 'email',
            'expires_at' => now()->addMinutes(15)
        ]);
    }

    public function generateMobileOtp()
    {
        return $this->otpVerifications()->create([
            'mobile' => $this->mobile,
            'otp_code' => $this->generateOtpCode(),
            'verification_type' => 'mobile',
            'expires_at' => now()->addMinutes(15)
        ]);
    }

    protected function generateOtpCode()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}

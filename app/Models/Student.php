<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'secondary_roll',
        'email',
        'mobile',
        'password'
    ];

    protected $casts = [
        'uuid' => 'string',
    ];

    // Relationships
    public function profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    // public function profiles()
    // {
    //     return $this->hasMany(StudentProfile::class);
    // }

    // public function currentProfile()
    // {
    //     return $this->hasOne(StudentProfile::class)->where('is_current', true);
    // }

    public function qualifications()
    {
        return $this->hasMany(AcademicQualification::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

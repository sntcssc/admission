<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['uuid'];

    protected $casts = [
        'uuid' => 'string',
    ];

    // Relationships
    public function profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

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

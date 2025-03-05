<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'dob', 'gender',
        'category', 'is_pwbd', 'father_name', 'mother_name',
        'father_occupation', 'mother_occupation', 'mobile', 'alternate_mobile',
        'whatsapp', 'email', 'alternate_email', 'family_income',
        'school_language', 'secondary_roll', 'upsc_community',
        'activities', 'hobbies', 'distance', 'valid_from', 'valid_until', 'is_current'
    ];

    protected $casts = [
        'dob' => 'date',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'activities' => 'array',
        'hobbies' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

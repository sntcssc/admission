<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'level', 'institute', 'board_university',
        'subjects', 'year_passed', 'total_marks', 'marks_obtained',
        'percentage', 'cgpa', 'division', 'is_completed'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

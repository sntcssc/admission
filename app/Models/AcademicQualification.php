<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AcademicQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'level',
        'institute',
        'board_university',
        'subjects',
        'year_passed',
        'total_marks',
        'marks_obtained',
        'percentage',
        'cgpa',
        'division',
        'is_completed'
    ];

    protected $casts = [
        'subjects' => 'array',
        'year_passed' => 'integer',
        'total_marks' => 'decimal:2',
        'marks_obtained' => 'decimal:2',
        'percentage' => 'decimal:2',
        'cgpa' => 'decimal:2',
        'is_completed' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

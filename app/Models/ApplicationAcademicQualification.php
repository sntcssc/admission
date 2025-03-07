<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAcademicQualification extends Model
{
        protected $fillable = [
        'application_id', 'level', 'institute', 'board_university', 'subjects',
        'year_passed', 'total_marks', 'marks_obtained', 'percentage', 'cgpa',
        'division', 'is_completed'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

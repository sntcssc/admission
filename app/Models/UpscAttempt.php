<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpscAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'application_id',
        'exam_year',
        'roll_number',
        'prelims_cleared',
        'mains_cleared',
        'attempt_number'
    ];

    protected $casts = [
        'prelims_cleared' => 'boolean',
        'mains_cleared' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

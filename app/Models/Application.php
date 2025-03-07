<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'advertisement_id',
        'batch_program_id',
        'application_number',
        'optional_subject',
        'is_appearing_upsc_cse',
        'upsc_attempts_count',
        'status',
        'payment_status',
        'applied_at'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'is_appearing_upsc_cse' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function batchProgram()
    {
        return $this->belongsTo(BatchProgram::class);
    }

    // For ApplicationAcademicQualification Table
    public function academicQualifications()
    {
        return $this->hasMany(ApplicationAcademicQualification::class);
    }

    //  For ApplicationAddress table

    public function applicationAddresses()
    {
        return $this->hasMany(ApplicationAddress::class);
    }
}

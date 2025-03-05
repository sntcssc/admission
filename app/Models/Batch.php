<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'academic_year',
        'code',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'academic_year' => 'string',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class)
            ->using(BatchProgram::class)
            ->withPivot('fee', 'available_seats', 'max_applications', 'status');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}

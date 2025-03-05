<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'academic_year', 'code', 
        'start_date', 'end_date', 'status'
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'batch_programs')
                    ->using(BatchProgram::class)
                    ->withPivot('fee', 'available_seats', 'status');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}

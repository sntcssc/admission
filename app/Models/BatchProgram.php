<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BatchProgram extends Model
{
    use HasFactory;

    protected $table = 'batch_programs';
    
    public $incrementing = true;

    protected $fillable = [
        'batch_id', 'program_id', 'fee',
        'available_seats', 'max_applications', 'status'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdvertisementProgram extends Model
{
    use HasFactory;

    protected $table = 'advertisement_programs';
    
    public $incrementing = true;

    protected $fillable = [
        'advertisement_id', 'batch_program_id', 'available_seats'
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function batchProgram()
    {
        return $this->belongsTo(BatchProgram::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvertisementProgram extends Model
{
    use HasFactory;

    protected $table = 'advertisement_programs';

    protected $fillable = [
        'advertisement_id',
        'batch_program_id',
        'available_seats'
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

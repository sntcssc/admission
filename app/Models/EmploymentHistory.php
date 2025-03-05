<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'is_employed',
        'designation', 'employer', 'location'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

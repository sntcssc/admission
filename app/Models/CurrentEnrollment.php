<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrentEnrollment extends Model
{
    use HasFactory;

    protected $fillable = ['application_id', 'course_name', 'institute'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

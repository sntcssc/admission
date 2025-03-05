<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'type',
        'state',
        'district',
        'subdistrict',
        'address_line1',
        'address_line2',
        'post_office',
        'police_station',
        'pin_code',
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

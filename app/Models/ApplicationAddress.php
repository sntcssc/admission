<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAddress extends Model
{
    protected $fillable = [
        'application_id', 'type', 'state', 'district', 'subdistrict', 
        'address_line1', 'address_line2', 'post_office', 'police_station', 
        'pin_code', 'is_verified'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

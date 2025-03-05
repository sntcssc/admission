<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'documentable_id', 'documentable_type',
    //     'type', 'file_path', 'verified_at', 'verification_status'
    // ];

    // public function documentable()
    // {
    //     return $this->morphTo();
    // }

    protected $fillable = [
        'application_id',
        'type',
        'file_path',
        'uploaded_at',
        'verified_at',
        'verification_status',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'screenshot_document_id');
    }
}
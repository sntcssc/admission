<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'amount', 'method',
        'transaction_date', 'transaction_id',
        'status', 'screenshot_document_id'
    ];

    protected $casts = [
        'transaction_date' => 'date'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function screenshot()
    {
        return $this->belongsTo(Document::class, 'screenshot_document_id');
    }
}
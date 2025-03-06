<?php

// app/Services/ApplicationLogger.php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class ApplicationLogger
{
    public function logActivity(string $activity, array $context = [])
    {
        Log::channel('activity')->info($activity, [
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            ...$context
        ]);
    }

    public function logError(\Throwable $exception)
    {
        Log::channel('error')->error($exception->getMessage(), [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\OtpVerificationException;

class CustomExceptionHandler extends ExceptionHandler
{
    // public function render($request, Throwable $e) {
    //     if ($e instanceof \App\Exceptions\OtpVerificationException) {
    //         return response()->view('errors.otp-error', ['message' => $e->getMessage()], 400);
    //     }
        
    //     return parent::render($request, $e);
    // }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof OtpVerificationException) {
            return response()->view('errors.otp-verification', [
                'message' => $exception->getMessage()
            ], 400);
        }

        return parent::render($request, $exception);
    }
}

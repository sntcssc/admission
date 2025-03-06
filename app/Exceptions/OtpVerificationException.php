<?php

namespace App\Exceptions;

use Exception;

class OtpVerificationException extends Exception
{
    //
    protected $message = 'OTP verification failed';
}

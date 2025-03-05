<?php

namespace App\Services;

use App\Models\OtpVerification;
use Illuminate\Support\Facades\Cache;

class OtpService
{
    public function generateOtp($email)
    {
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(15);

        OtpVerification::updateOrCreate(
            ['email' => $email],
            ['otp' => $otp, 'expires_at' => $expiresAt]
        );

        return $otp;
    }

    public function verifyOtp($email, $otp)
    {
        $verification = OtpVerification::where('email', $email)
            ->where('otp', $otp)
            ->where('expires_at', '>', now())
            ->first();

        if ($verification) {
            $verification->delete();
            return true;
        }

        return false;
    }
}
<?php

namespace App\Services;

use App\Repositories\Contracts\OtpRepositoryInterface;
use App\Services\Contracts\OtpServiceInterface;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService implements OtpServiceInterface
{
    protected $otpRepository;

    public function __construct(OtpRepositoryInterface $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    // public function generateOtp(string $type, ?string $email = null, ?string $mobile = null)
    // {
    //     $existingOtp = $this->otpRepository->findLatestByType($type, $email, $mobile);
        
    //     if ($existingOtp && $existingOtp->created_at->addSeconds(30)->isFuture()) {
    //         throw new \Exception('Please wait before requesting new OTP');
    //     }

    //     $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    //     $expiresAt = Carbon::now()->addMinutes(config('otp.expiration_time', 15));

    //     return $this->otpRepository->create([
    //         'email' => $email,
    //         'mobile' => $mobile,
    //         'otp_code' => $otpCode,
    //         'type' => $type,
    //         'expires_at' => $expiresAt
    //     ]);
    // }

    public function verifyOtp(string $type, string $code, ?string $email = null, ?string $mobile = null)
    {
        $otp = $this->otpRepository->findValidOtp($type, $code, $email, $mobile);

        if (!$otp) {
            return false;
        }

        $this->otpRepository->markAsVerified($otp->id);
        return true;
    }

    public function isVerified(string $email, string $mobile): bool
    {
        return $this->otpRepository->isVerified($email, $mobile);
    }


    // app/Services/OtpService.php
    public function generateOtp(string $type, ?string $email = null, ?string $mobile = null, bool $isResend = false)
    {
        $existingOtp = $this->otpRepository->findLatestByType($type, $email, $mobile);

        if ($isResend) {
            $maxResendAttempts = config('otp.max_resend_attempts', 3);
            $resendCooldown = config('otp.resend_cooldown', 60); // seconds
            
            $resendCount = $this->otpRepository->getResendCount($type, $email, $mobile);
            
            if ($resendCount >= $maxResendAttempts) {
                throw new \Exception('Maximum resend attempts reached');
            }
            
            if ($existingOtp && Carbon::parse($existingOtp->last_resend_at)->addSeconds($resendCooldown)->isFuture()) {
                throw new \Exception('Please wait before resending OTP');
            }
        } else {
            if ($existingOtp && $existingOtp->created_at->addSeconds(30)->isFuture()) {
                throw new \Exception('Please wait before requesting new OTP');
            }
        }

        $otpCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(config('otp.expiration_time', 15));

        $otp = $this->otpRepository->create([
            'email' => $email,
            'mobile' => $mobile,
            'otp_code' => $otpCode,
            'type' => $type,
            'expires_at' => $expiresAt,
            'last_resend_at' => $isResend ? Carbon::now() : null,
        ]);

        if ($isResend && $existingOtp) {
            $this->otpRepository->incrementResendCount($existingOtp->id);
        }

        return $otp;
    }

}
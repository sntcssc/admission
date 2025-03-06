<?php

namespace App\Repositories;

use App\Models\OtpVerification;
use Carbon\Carbon;
use App\Repositories\Contracts\OtpRepositoryInterface;

class OtpRepository implements OtpRepositoryInterface
{
    public function create(array $data)
    {
        return OtpVerification::create($data);
    }

    public function findLatestByType(string $type, ?string $email, ?string $mobile)
    {
        return OtpVerification::where('type', $type)
            ->when($email, fn($q) => $q->where('email', $email))
            ->when($mobile, fn($q) => $q->where('mobile', $mobile))
            ->latest()
            ->first();
    }

    public function findValidOtp(string $type, string $code, ?string $email, ?string $mobile)
    {
        return OtpVerification::where('type', $type)
            ->where('otp_code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->when($email, fn($q) => $q->where('email', $email))
            ->when($mobile, fn($q) => $q->where('mobile', $mobile))
            ->whereNull('verified_at')
            ->first();
    }

    public function markAsVerified(int $id)
    {
        return OtpVerification::where('id', $id)->update([
            'verified_at' => Carbon::now()
        ]);
    }

    public function isVerified(string $email, string $mobile): bool
    {
        return OtpVerification::where('email', $email)
            ->orWhere('mobile', $mobile)
            ->whereNotNull('verified_at')
            ->exists();
    }

    // app/Repositories/OtpRepository.php
    public function incrementResendCount(int $id)
    {
        return OtpVerification::where('id', $id)->increment('resend_count');
    }

    public function getResendCount(string $type, ?string $email, ?string $mobile): int
    {
        return OtpVerification::where('type', $type)
            ->when($email, fn($q) => $q->where('email', $email))
            ->when($mobile, fn($q) => $q->where('mobile', $mobile))
            ->sum('resend_count');
    }
}
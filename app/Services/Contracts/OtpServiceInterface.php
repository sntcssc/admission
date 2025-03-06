<?php

// app/Services/Contracts/OtpServiceInterface.php
namespace App\Services\Contracts;

interface OtpServiceInterface {
    public function generateOtp(string $type, string $email = null, string $mobile = null);
    public function verifyOtp(string $type, string $code, string $email = null, string $mobile = null);
    public function isVerified(string $email, string $mobile): bool;
}
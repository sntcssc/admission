<?php

namespace App\Repositories\Contracts;

interface OtpRepositoryInterface
{
    public function create(array $data);
    public function findLatestByType(string $type, ?string $email, ?string $mobile);
    public function findValidOtp(string $type, string $code, ?string $email, ?string $mobile);
    public function markAsVerified(int $id);
    public function isVerified(string $email, string $mobile): bool;

    // app/Repositories/Contracts/OtpRepositoryInterface.php
public function incrementResendCount(int $id);
public function getResendCount(string $type, ?string $email, ?string $mobile): int;
}
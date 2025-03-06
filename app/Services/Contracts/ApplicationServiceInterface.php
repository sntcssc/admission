<?php

// app/Services/Contracts/ApplicationServiceInterface.php
namespace App\Services\Contracts;

interface ApplicationServiceInterface
{
    public function getAvailableAdvertisements();
    public function createApplication(int $studentId, int $advertisementId);
    public function getApplicationStatus(int $applicationId);
}
<?php

namespace App\Repositories\Contracts;

interface ApplicationRepositoryInterface
{
    public function getActiveAdvertisements();
    public function hasExistingApplication(int $studentId, int $advertisementId);
    public function createApplication(array $applicationData);
    public function getApplicationWithStatus(int $applicationId);

}
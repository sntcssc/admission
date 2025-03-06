<?php

// app/Services/ApplicationService.php
namespace App\Services;

use App\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Services\Contracts\ApplicationServiceInterface;
use Illuminate\Support\Facades\DB;

class ApplicationService implements ApplicationServiceInterface
{
    protected $applicationRepo;

    public function __construct(ApplicationRepositoryInterface $applicationRepo)
    {
        $this->applicationRepo = $applicationRepo;
    }

    public function getAvailableAdvertisements()
    {
        return DB::transaction(function () {
            return $this->applicationRepo->getActiveAdvertisements();
        });
    }

    public function createApplication(int $studentId, int $advertisementId)
    {
        return DB::transaction(function () use ($studentId, $advertisementId) {
            if ($this->applicationRepo->hasExistingApplication($studentId, $advertisementId)) {
                throw new \Exception('You already applied for this advertisement');
            }
            
            return $this->applicationRepo->createApplication([
                'student_id' => $studentId,
                'advertisement_id' => $advertisementId,
                'status' => 'submitted'
            ]);
        });
    }

    public function getApplicationStatus(int $applicationId)
    {
        return $this->applicationRepo->getApplicationWithStatus($applicationId);
    }
}
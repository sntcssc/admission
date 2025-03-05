<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Contracts\Services\ApplicationServiceInterface;

class ApplicationService implements ApplicationServiceInterface
{
    protected $applicationRepo;
    
    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepo = $applicationRepo;
    }

    public function submitApplication(array $data, $student)
    {
        try {
            $application = $this->applicationRepo->createApplication($data, $student->id);
            
            $this->handleDocuments($application, $data['documents']);
            $this->handlePayment($application, $data['payment']);
            
            return $application;
            
        } catch (\Exception $e) {
            Log::error("Application submission failed: {$e->getMessage()}");
            throw new ApplicationException("Application submission failed. Please try again.");
        }
    }
}
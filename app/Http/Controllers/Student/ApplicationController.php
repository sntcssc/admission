<?php

// app/Http/Controllers/Student/ApplicationController.php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ApplicationServiceInterface;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationServiceInterface $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function index()
    {
        $advertisements = $this->applicationService->getAvailableAdvertisements();
        // dd($advertisements);
        return view('student.dashboard.applications', compact('advertisements'));
    }

    public function create($advertisementId)
    {
        try {
            $application = $this->applicationService->createApplication(
                auth('student')->id(),
                $advertisementId
            );
            
            return redirect()->route('student.application.status', $application->id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showStatus($applicationId)
    {
        $application = $this->applicationService->getApplicationStatus($applicationId);
        return view('student.dashboard.application-status', compact('application'));
    }
}
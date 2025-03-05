<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Services\ApplicationService;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->middleware('auth:student');
        $this->applicationService = $applicationService;
    }

    public function store(StoreApplicationRequest $request)
    {
        try {
            $application = $this->applicationService->submitApplication(
                $request->validated(),
                $request->user()
            );
            
            return response()->json([
                'redirect' => route('application.status', $application),
                'message' => 'Application submitted successfully!'
            ]);

        } catch (\App\Exceptions\ApplicationException $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
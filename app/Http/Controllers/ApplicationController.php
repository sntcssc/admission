<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Services\ApplicationService;
use App\Http\Requests\StoreApplicationRequest;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $service)
    {
        $this->applicationService = $service;
    }

    public function create()
    {
        return view('applications.create', [
            'advertisements' => Advertisement::active()->get(),
            'steps' => config('application.steps')
        ]);
    }

    public function store(StoreApplicationRequest $request)
    {
        try {
            $application = DB::transaction(function () use ($request) {
                return $this->applicationService->createApplication(
                    $request->validated(),
                    auth()->user()
                );
            });
            
            return redirect()->route('applications.preview', $application);
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Application submission failed: '.$e->getMessage()]);
        }
    }
}

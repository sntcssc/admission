<?php

namespace App\Repositories;

use App\Models\Application;
use App\Contracts\Repositories\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function createApplication(array $data, $studentId)
    {
        return DB::transaction(function () use ($data, $studentId) {
            $application = Application::create([
                'student_id' => $studentId,
                ...$data
            ]);
            
            $this->createApplicationTimeline($application, 'created');
            
            return $application;
        });
    }
    
    protected function createApplicationTimeline($application, $event)
    {
        $application->timelines()->create([
            'event_type' => $event,
            'event_data' => json_encode($application->toArray())
        ]);
    }
}
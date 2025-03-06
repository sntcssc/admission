<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Advertisement;
use App\Repositories\Contracts\ApplicationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    protected $advertisement;

    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function getActiveAdvertisements()
    {
        return $this->advertisement
            ->where('status', 'published')
            ->get();
    }

    public function hasExistingApplication(int $studentId, int $advertisementId)
    {
        return $this->advertisement
            ->where('student_id', $studentId)
            ->where('advertisement_id', $advertisementId)
            ->exists();
    }

    public function createApplication(array $applicationData)
    {
        return $this->advertisement->create($applicationData);
    }

    public function getApplicationWithStatus(int $applicationId)
    {
        return $this->advertisement
            ->with('status')
            ->find($applicationId);
    }
}
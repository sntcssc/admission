<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;

class StudentRepository implements StudentRepositoryInterface
{
    // public function create(array $data)
    // {
    //     return Student::create($data);
    // }

    // public function findByEmail(string $email)
    // {
    //     return Student::where('email', $email)->first();
    // }

    public function createWithProfile(array $studentData, array $profileData)
    {
        return DB::transaction(function () use ($studentData, $profileData) {
            $student = Student::create($studentData);
            $student->profile()->create($profileData);
            return $student;
        });
    }

    public function findByProfileEmail(string $email)
    {
        return Student::whereHas('profile', function($query) use ($email) {
            $query->where('email', $email);
        })->first();
    }
}
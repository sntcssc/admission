<?php

namespace App\Services;

use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Support\Facades\Hash;

class StudentService implements StudentServiceInterface
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    // public function createStudent(array $data)
    // {
    //     $data['password'] = Hash::make($data['password']);
    //     return $this->studentRepository->create($data);
    // }

    public function registerStudent(array $registrationData)
    {
        $studentData = [
            'secondary_roll' => $registrationData['secondary_roll'],
            'email' => $registrationData['email'],
            'mobile' => $registrationData['mobile'],
            'password' => Hash::make($registrationData['password']),
            'uuid' => \Illuminate\Support\Str::orderedUuid(),
        ];

        $profileData = collect($registrationData)
            ->except('password', 'password_confirmation')
            ->toArray();

        return $this->studentRepository->createWithProfile($studentData, $profileData);
    }
}
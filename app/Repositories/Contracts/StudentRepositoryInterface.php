<?php

// app/Repositories/Contracts/StudentRepositoryInterface.php
namespace App\Repositories\Contracts;

interface StudentRepositoryInterface {
    // public function createStudent(array $data);
    // public function findStudentByEmail(string $email);

    // public function create(array $data);
    // public function findByEmail(string $email);
    
    public function createWithProfile(array $studentData, array $profileData);
    public function findByProfileEmail(string $email);
}
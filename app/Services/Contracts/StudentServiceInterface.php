<?php

namespace App\Services\Contracts;

interface StudentServiceInterface
{
    // public function createStudent(array $data);
    public function registerStudent(array $registrationData);
}
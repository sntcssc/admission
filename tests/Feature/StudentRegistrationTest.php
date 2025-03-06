<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_complete_registration_flow()
    {
        // Test registration with OTP verification
        $this->post('/send-otp', [
            'type' => 'email',
            'email' => 'test@example.com'
        ])->assertStatus(200);

        // Verify OTP
        $this->post('/verify-otp', [
            'type' => 'email',
            'code' => '123456',
            'email' => 'test@example.com'
        ])->assertStatus(200);

        // Complete registration
        $response = $this->post('/register', [
            // ... registration data
        ]);

        $response->assertRedirect('/dashboard');
    }

    public function test_application_submission_flow()
    {
        $student = Student::factory()->create();
        $advertisement = Advertisement::factory()->create();

        $this->actingAs($student, 'student')
            ->post('/applications', ['advertisement_id' => $advertisement->id])
            ->assertRedirect();
    }
}
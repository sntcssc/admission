<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OtpServiceInterface;
use App\Services\Contracts\StudentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\OtpVerificationException;
use App\Http\Requests\StudentRegistrationRequest;

class AuthController extends Controller
{
    protected $studentService;
    protected $otpService;

    public function __construct(
        StudentServiceInterface $studentService,
        OtpServiceInterface $otpService
    ) {
        $this->studentService = $studentService;
        $this->otpService = $otpService;
    }

    public function showRegistrationForm()
    {
        // dd('lol');
        return view('student.auth.register');
    }

    // public function register(Request $request)
    // {
    //     // dd($request);
    //     try {
    //         DB::beginTransaction();
            
    //         $validated = $request->validate([
    //             'first_name' => 'required|max:50',
    //             'last_name' => 'required|max:50',
    //             'gender' => 'required|in:Male,Female,Other',
    //             'dob' => 'required|date|before:-18 years',
    //             'mobile' => 'required|digits:10|unique:students,mobile',
    //             'email' => 'required|email|unique:students,email',
    //             'password' => 'required|confirmed|min:8',
    //         ]);

    //         if (!$this->otpService->isVerified($validated['email'], $validated['mobile'])) {
    //             throw new OtpVerificationException('Please verify both email and mobile');
    //         }

    //         $student = $this->studentService->createStudent($validated);
            
    //         DB::commit();
            
    //         Auth::guard('student')->login($student);
            
    //         return redirect()->route('student.dashboard');

    //     } catch (OtpVerificationException $e) {
    //         DB::rollBack();
    //         Log::error('OTP Verification Error: ' . $e->getMessage());
    //         return back()->withInput()->withErrors(['otp' => $e->getMessage()]);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Registration Error: ' . $e->getMessage());
    //         return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
    //     }
    // }


    public function register(StudentRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            // Get validated data from custom request
            $validated = $request->validated();

            // Check verification using profile data
            if (!$this->otpService->isVerified($validated['email'], $validated['mobile'])) {
                throw new OtpVerificationException('Please verify both email and mobile');
            }

            $student = $this->studentService->registerStudent($validated);
            
            DB::commit();
            
            Auth::guard('student')->login($student);
            
            return redirect()->route('student.dashboard');

        } catch (OtpVerificationException $e) {
            DB::rollBack();
            Log::error('OTP Verification Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required|in:email,mobile',
    //         'email' => 'required_if:type,email|email',
    //         'mobile' => 'required_if:type,mobile|digits:10'
    //     ]);

    //     try {
    //         $otp = $this->otpService->generateOtp(
    //             $request->type,
    //             $request->email,
    //             $request->mobile
    //         );

    //         return response()->json([
    //             'message' => 'OTP sent successfully',
    //             'expires_in' => config('otp.expiration_time')
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('OTP Send Error: ' . $e->getMessage());
    //         return response()->json(['error' => 'Failed to send OTP'], 500);
    //     }
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required|in:email,mobile',
    //         'code' => 'required|digits:6',
    //         'email' => 'nullable|email',
    //         'mobile' => 'nullable|digits:10'
    //     ]);

    //     try {
    //         $verified = $this->otpService->verifyOtp(
    //             $request->type,
    //             $request->code,
    //             $request->email,
    //             $request->mobile
    //         );

    //         if ($verified) {
    //             return response()->json(['message' => 'OTP verified successfully']);
    //         }

    //         return response()->json(['error' => 'Invalid OTP'], 400);

    //     } catch (\Exception $e) {
    //         Log::error('OTP Verification Error: ' . $e->getMessage());
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'type' => 'required|in:email,mobile',
            'code' => 'required|digits:6',
            'email' => 'nullable|email',
            'mobile' => 'nullable|digits:10'
        ]);
    
        try {
            $verified = $this->otpService->verifyOtp(
                $request->type,
                $request->code,
                $request->email,
                $request->mobile
            );
    
            if ($verified) {
                return response()->json(['message' => 'OTP verified successfully']);
            }
    
            return response()->json(['error' => 'Invalid OTP'], 400);
    
        } catch (\Exception $e) {
            Log::error('OTP Verification Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }

    // app/Http/Controllers/Student/AuthController.php
    public function sendOtp(Request $request)
    {
        $request->validate([
            'type' => 'required|in:email,mobile',
            'email' => 'required_if:type,email|email',
            'mobile' => 'required_if:type,mobile|digits:10',
            'is_resend' => 'sometimes|boolean'
        ]);

        try {
            $otp = $this->otpService->generateOtp(
                $request->type,
                $request->email,
                $request->mobile,
                $request->boolean('is_resend')
            );

            return response()->json([
                'message' => $request->is_resend ? 'OTP resent successfully' : 'OTP sent successfully' . $otp->otp_code,
                'expires_in' => config('otp.expiration_time'),
                'cooldown' => config('otp.resend_cooldown')
            ]);

        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
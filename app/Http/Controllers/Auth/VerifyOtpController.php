<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Jobs\SendOtpEmail;
use Illuminate\Support\Facades\DB;

class VerifyOtpController extends Controller
{
    public function show()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $verification = DB::table('otp_verifications')
            ->where('email', $request->session()->get('registration_email'))
            ->latest()
            ->first();

        if (!$verification || $verification->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        Student::create($request->session()->get('registration_data'));
        auth()->login($student);
        
        return redirect()->route('dashboard');
    }
}

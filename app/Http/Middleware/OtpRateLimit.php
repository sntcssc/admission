<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpRateLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'otp_resend_'.$request->ip();
        
        if (RateLimiter::tooManyAttempts($key, config('otp.max_resend_attempts'))) {
            return response()->json([
                'error' => 'Too many resend attempts. Please try again later.'
            ], 429);
        }
    
        RateLimiter::hit($key, config('otp.resend_cooldown'));
    
        return $next($request);
    }
}

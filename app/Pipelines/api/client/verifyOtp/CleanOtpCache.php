<?php

namespace App\Pipelines\api\client\verifyOtp;
use Closure;
use Illuminate\Support\Facades\Cache;

// Clean up all OTP-related cache entries after successful verification
class CleanOtpCache
{
    public function __invoke($data, Closure $next)
    {
        $otpKey = "otp_{$data['phone']}";

        // Remove OTP, expiry, and user data
        Cache::forget($otpKey);
        Cache::forget("{$otpKey}_expires_at");
        Cache::forget("userData_{$data['phone']}");

        return $next($data);
    }
}


<?php

namespace App\Pipelines\api\client\verifyOtp;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Cache;

// Verify the OTP has not expired
class EnsureOtpNotExpired
{
    use ApiResponse;

    public function __invoke($data, Closure $next)
    {
        if (now()->greaterThan($data['expiresAt'])) {
            $otpKey = "otp_{$data['phone']}";

            // Clear OTP and user data
            Cache::forget($otpKey);
            Cache::forget("{$otpKey}_expires_at");
            Cache::forget("userData_{$data['phone']}");

            abort($this->setCode(401)->setError('OTP has expired.')->send());
        }

        return $next($data);
    }
}


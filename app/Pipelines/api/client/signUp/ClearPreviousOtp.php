<?php

namespace App\Pipelines\api\client\signUp;
use Closure;
use Illuminate\Support\Facades\Cache;

class ClearPreviousOtp
{
    public function __invoke($data, Closure $next)
    {
        // Remove any previously cached OTP and expiration for the same user
        $phone = $data['phone'];

        $otpKey = "otp_{$phone}";
        $expiresKey = "{$otpKey}_expires_at";
        $userDataKey = "userData_{$phone}";

        Cache::forget($otpKey);
        Cache::forget($expiresKey);
        Cache::forget($userDataKey);

        return $next($data);
    }
}

<?php

namespace App\Pipelines\api\client\signUp;

use Closure;
use Illuminate\Support\Facades\Cache;

class GenerateAndCacheOtp
{
    public function __invoke($data, Closure $next)
    {
        $phone = $data['phone'];

        // Define cache keys
        $otpKey = "otp_{$phone}";
        $expiresKey = "{$otpKey}_expires_at";
        $lockKey = "{$otpKey}_lock";
        $userDataKey = "userData_{$phone}";

        // Generate a random 4-digit OTP
        $otpCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(2); // OTP expiration

        // Store OTP, expiration, lock, and user data in cache
        Cache::put($otpKey, $otpCode, now()->addMinutes(30));
        Cache::put($expiresKey, $expiresAt, now()->addMinutes(30));
        Cache::put($lockKey, true, now()->addMinute());
        Cache::put($userDataKey, $data, now()->addMinutes(30));

        // Add OTP info to data array
        $data['otpCode'] = $otpCode;
        $data['expiresAt'] = $expiresAt;

        return $next($data); // Pass modified data to final handler
    }
}


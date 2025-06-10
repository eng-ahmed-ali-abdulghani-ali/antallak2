<?php

namespace App\Pipelines\api\client\verifyOtp;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Cache;

// Fetch cached OTP and expiry time for given phone
class EnsureOtpExists
{
    use ApiResponse;

    public function __invoke($data, Closure $next)
    {
        $otpKey = "otp_{$data['phone']}";
        $expiresKey = "{$otpKey}_expires_at";

        // Attach to data array for later steps
        $data['cachedOtp'] = Cache::get($otpKey);
        $data['expiresAt'] = Cache::get($expiresKey);

        if (!$data['cachedOtp'] || !$data['expiresAt']) {
            abort($this->setCode(401)->setError('OTP is invalid or has expired.')->send());
        }

        return $next($data);
    }
}


<?php

namespace App\Pipelines\api\client\signUp;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Cache;

class ThrottleOtpRequests
{
    use ApiResponse;

    public function __invoke($data, Closure $next)
    {
        // Prevent too many OTP requests within a short time
        $phone = $data['phone'];
        $lockKey = "otp_{$phone}_lock";

        if (Cache::has($lockKey)) {
            abort($this->setCode(429)->setError('OTP already sent. Please wait a minute before requesting it again.')->send());
        }

        return $next($data);
    }
}

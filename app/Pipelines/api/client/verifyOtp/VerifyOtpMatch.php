<?php

namespace App\Pipelines\api\client\verifyOtp;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Cache;
// Match the user-provided OTP with the cached value
class VerifyOtpMatch
{
    use ApiResponse;
    public function __invoke($data, Closure $next)
    {
        if ($data['cachedOtp'] !== $data['otp']) {
            abort($this->setCode(401)->setError('Incorrect OTP.')->send());
        }

        return $next($data);
    }
}


<?php

namespace App\Services\api\client;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AuthClientService
{

    public function signUp(array $data)
    {
        $phone = $data['phone'];
        $type = 'client';

        // Define cache keys
        $otpKey = "otp_{$type}_{$phone}";
        $expiresKey = "{$otpKey}_expires_at";
        $lockKey = "{$otpKey}_lock";

        // Check if OTP request is locked (throttle)
        if (Cache::has($lockKey)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP already sent. Please wait before requesting again.',
            ], 429); // Too Many Requests
        }

        // Clear any previous OTPs
        Cache::forget($otpKey);
        Cache::forget($expiresKey);

        // Generate OTP
        $otpCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(2); // OTP expires in 2 minutes

        // Store OTP and metadata in cache (30-minute retention)
        Cache::put($otpKey, $otpCode, 1800);
        Cache::put($expiresKey, $expiresAt, 1800);
        Cache::put($lockKey, true, 60); // lock for 1 minute
        Cache::put("userData_{$phone}", $data, 1800);

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.',
            'otpCode' => $otpCode, //  REMOVE in production!
            'expiresAt' => $expiresAt,
        ]);
    }


    public function verifyOtp(array $data)
    {
        $phone = $data['phone'];
        $otpInput = $data['otp'];
        $type = 'client';

        // Define cache keys
        $otpKey = "otp_{$type}_{$phone}";
        $expiresKey = "{$otpKey}_expires_at";
        $userDataKey = "userData_{$phone}";

        // Retrieve cached values
        $cachedOtp = Cache::get($otpKey);
        $expiresAt = Cache::get($expiresKey);

        if (!$cachedOtp || !$expiresAt) {
            return response()->json([
                'success' => false,
                'message' => 'OTP is invalid or has expired.',
            ], 401);
        }

        if (now()->greaterThan($expiresAt)) {
            Cache::forget($otpKey);
            Cache::forget($expiresKey);
            Cache::forget($userDataKey);

            return response()->json([
                'success' => false,
                'message' => 'OTP has expired.',
            ], 401);
        }

        if ($cachedOtp !== $otpInput) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect OTP.',
            ], 401);
        }

        // OTP is valid — create user
        $userData = Cache::get($userDataKey);

        try {
            $user = User::create($userData);

            //  Generate access token
            $token = $user->createToken('auth_token')->plainTextToken;

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user.',
                'error' => $e->getMessage(),
            ], 500);
        }

        // Clean up cache
        Cache::forget($otpKey);
        Cache::forget($expiresKey);
        Cache::forget($userDataKey);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'user' => $user,
            'token' => $token, // return access token
            'token_type' => 'Bearer',
        ]);
    }


}

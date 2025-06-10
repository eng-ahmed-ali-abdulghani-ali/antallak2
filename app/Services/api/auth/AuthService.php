<?php

namespace App\Services\api\auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Pipelines\api\client\signUp\{ClearPreviousOtp, GenerateAndCacheOtp, ThrottleOtpRequests};
use App\Pipelines\api\client\verifyOtp\{CleanOtpCache,
    CreateUserAndToken,
    EnsureOtpExists,
    EnsureOtpNotExpired,
    VerifyOtpMatch};
use App\Traits\ApiResponse;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use ApiResponse;


    public function signUp(array $data)
    {
        return app(Pipeline::class)
            // Send the input data through a sequence of pipeline classes
            ->send($data)
            ->through([
                ThrottleOtpRequests::class,    // Check if the user is making OTP requests too frequently
                ClearPreviousOtp::class,      // Remove any previous OTPs for the user before generating a new one
                GenerateAndCacheOtp::class,   // Generate a new OTP and cache it with an expiry time
            ])
            ->then(function ($data) {
                // Return a successful JSON response after all pipeline stages complete
                return $this->setCode(200)
                    ->setSuccess('OTP sent successfully.')
                    ->setData([
                        'otpCode' => $data['otpCode'],      // ⚠️ For development only – remove this line in production
                        'expiresAt' => $data['expiresAt']->format('d M Y, h:i A'),  // Timestamp when the OTP will expire
                    ])->send();
            });
    }


    // This method verifies the user's OTP using a pipeline for modular validation and processing
    public function verifyOtp(array $data)
    {
        return app(Pipeline::class)
            ->send($data) // Input data: phone + OTP
            ->through([
                EnsureOtpExists::class,      // Check if OTP and expiration are present in cache
                EnsureOtpNotExpired::class,  // Check if OTP has expired
                VerifyOtpMatch::class,       // Verify OTP matches user input
                CreateUserAndToken::class,   // Create user and generate token
                CleanOtpCache::class,        // Clear OTP data from cache
            ])
            ->then(function ($data) {
                // Final response if all pipeline steps succeed
                return $this->setCode(200)->setSuccess('OTP verified successfully.')
                    ->setData([
                        'user' => new UserResource($data['user']),
                        'token' => $data['token'],
                    ])->send();
            });
    }




    public function signIn(array $data)
    {
        $phone = $data['phone'];
        $password = $data['password'];

        // Try to find the user by phone
        $user = User::where('phone', $phone)->first();

        // If user not found
        if (!$user) {
            return $this->setCode(404)->setError('User not found.')->send();
        }
        // Check password
        if (!Hash::check($password, $user->password)) {
            return $this->setCode(401)->setError('Incorrect password.')->send();
        }
        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->setCode(200)->setSuccess('Login successful.')
            ->setData([
                'user' => new  UserResource($user),
                'token' => $token,
            ])->send();
    }



}

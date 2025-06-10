<?php

namespace App\Pipelines\api\client\verifyOtp;

use App\Models\User;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

// Create a new user and issue an authentication token
class CreateUserAndToken
{
    use ApiResponse;

    public function __invoke($data, Closure $next)
    {
        // Get user data stored during sign-up
        $userData = Cache::get("userData_{$data['phone']}");

        if (!$userData) {
            abort($this->setCode(404)->setError('User data not found.')->send());
        }

        try {
            // Save user and issue token
            $userData['password'] = Hash::make($userData['password']);

            $user = User::create($userData);

            if (in_array($userData['role'], ['driver', 'supervisor'])) {
                $user->is_active = false;    // both drivers and supervisors start as inactive
            }
            $user->phone_verified_at = now();
            $user->save();
            $token = $user->createToken('clientAuthToken')->plainTextToken;
            // Add to pipeline data
            $data['user'] = $user;
            $data['token'] = $token;
        } catch (\Exception $e) {
            abort($this->setCode(500)->setError('Failed to create user.')->setData(['error' => $e->getMessage()])->send());
        }

        return $next($data);
    }
}


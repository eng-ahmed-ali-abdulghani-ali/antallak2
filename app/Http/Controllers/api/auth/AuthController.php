<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\auth\SignInRequest;
use App\Http\Requests\api\auth\SignUpRequest;
use App\Http\Requests\api\profile\VerifyOtpRequest;
use App\Services\api\auth\AuthService;

class AuthController extends Controller
{

    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signUp(SignUpRequest $request)
    {
        return $this->authService->signUp($request->validated());
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        return $this->authService->verifyOtp($request->validated());
    }

    public function signIn(SignInRequest $request)
    {
        return $this->authService->signIn($request->validated());
    }



}

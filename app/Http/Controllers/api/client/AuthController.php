<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\client\SignUpClientRequest;
use App\Http\Requests\api\client\VerifyOtpClientRequest;
use App\Services\api\client\AuthClientService;

class AuthController extends Controller
{

    public $authService;

    public function __construct(AuthClientService $authService)
    {
        $this->authService = $authService;
    }

    public function signUp(SignUpClientRequest $request)
    {
        return $this->authService->signUp($request->validated());
    }

    public function verifyOtp(VerifyOtpClientRequest $request)
    {
        return $this->authService->verifyOtp($request->validated());
    }

}

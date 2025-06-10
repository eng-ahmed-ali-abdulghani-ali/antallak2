<?php

namespace App\Http\Controllers\api\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\profile\UpdateProfileRequest;
use App\Services\api\profile\ProfileClientService;

class ProfileController extends Controller
{
    public $profileClientService;

    public function __construct(ProfileClientService $profileClientService)
    {
        $this->profileClientService = $profileClientService;
    }

    public function UpdateProfile(UpdateProfileRequest $request)
    {
        return $this->profileClientService->UpdateProfile($request->validated());
    }
}

<?php

namespace App\Services\api\profile;

use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileClientService
{
    use ApiResponse;

    public function UpdateProfile(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user = Auth::user();
        $user->update($data);
        return $this->setCode(200)->setSuccess('Profile updated successfully.')->setData([
            'user' => new UserResource($user),
        ])->send();
    }



}

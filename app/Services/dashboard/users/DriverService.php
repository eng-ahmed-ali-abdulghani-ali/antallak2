<?php

namespace App\Services\dashboard\users;

use App\Http\Requests\dashboard\users\CreateDriverRequest;

use App\Models\DriverInfo;
use App\Models\User;

class DriverService
{
  public function create(CreateDriverRequest $request)
  {
    $data = $request->validated();
    $data['password'] = bcrypt($data['password']);
    $data['role'] = 'driver';
    $data['status'] = 'active';

    $user = User::create([
      'name' => $data['name'],
      'password' => $data['password'],
      'phone' => $data['phone'],
      'role' => $data['role'],
      'status' => $data['status'],
      'is_active' => true,

    ]);
    $driverInfo = DriverInfo::create([
      'user_id' => $user->id,
      'date_of_birth' => $data['birth_date'],
      'iqama_number' => $data['iqama_number'],
      'iqama_expiry' => $data['iqama_expiry'],
      'driving_license_expiry' => $data['driving_license_expiry'],
      'under_kafala' => $data['under_kafala'] ?? false,
      'vehicle_name' => $data['vehicle_name'],
      'vehicle_model_year' => $data['vehicle_model_year'],
      'number_plate' => $data['number_plate'],
    ]);

    if ($request->hasFile('iqama_image')) {
      $user->addMedia($request->file('iqama_image'))->toMediaCollection('iqama_image');
    }
    if ($request->hasFile('license_image')) {
      $user->addMedia($request->file('license_image'))->toMediaCollection('license_image');
    }
    if ($request->hasFile('vehicle_license_image')) {
      $user->addMedia($request->file('vehicle_license_image'))->toMediaCollection('vehicle_license_image');
    }
    if ($request->hasFile('selfie_image')) {
      $user->addMedia($request->file('selfie_image'))->toMediaCollection('selfie_image');
    }
    if ($request->hasFile('vehicle_front_image')) {
      $user->addMedia($request->file('vehicle_front_image'))->toMediaCollection('vehicle_front_image');
    }
    if ($request->hasFile('vehicle_back_image')) {
      $user->addMedia($request->file('vehicle_back_image'))->toMediaCollection('vehicle_back_image');
    }
    return $user;
  }
}

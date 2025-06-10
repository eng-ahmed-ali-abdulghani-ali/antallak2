<?php

namespace App\Services\api\client;

use App\Models\Service;

class ServiceService
{
  public function getAll()
  {
    return  Service::all();
  }

  public function getById($id)
  {
    return Service::findOrFail($id);
  }

  public function create(array $data)
  {
    $service = Service::create([
      'name' => $data['name'],
    ]);
    if (isset($data['image'])) {
      $service->addMedia($data['image'])->toMediaCollection('image');
    }
    return $service;
  }

  public function update(array $data, $id)
  {
    $service = Service::findOrFail($id);
    $service->update([
      'name' => $data['name'],
    ]);

    if (isset($data['image'])) {
      $service->clearMediaCollection('image');

      $service->addMedia($data['image'])->toMediaCollection('image');
    }
  }
  public function delete($id)
  {
    $Service = Service::findOrFail($id);
    return ($Service->delete());
  }
}

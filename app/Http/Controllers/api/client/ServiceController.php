<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Http\Resources\client\ServicesResource;
use App\Http\Resources\UserResource;
use App\Models\Service;
use App\Services\api\client\ServicesService;
use App\Traits\ApiResponse;

class ServiceController extends Controller
{
    use ApiResponse;

    public $services;

    public function __construct(ServicesService $services)
    {
        $this->services = $services;
    }

    public function getServices()
    {
        return $this->services->getServices();
    }

}

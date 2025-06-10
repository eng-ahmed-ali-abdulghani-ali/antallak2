<?php

namespace App\Services\api\client;

use App\Http\Resources\client\ServicesResource;
use App\Models\Service;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\App;

class ServicesService
{
    use ApiResponse;

    public function getServices()
    {
        ///dd(App::getLocale());
        // Fetch only the 'id' and 'name' fields from all service records
        $services = Service::with('translation')->get();

        // If no services are found, return a 404 response with an appropriate message
        if ($services->isEmpty()) {
            return $this->setCode(404)->setSuccess(false)->setMessage('No services found.')->send();
        }

        // Return successful response with the list of services using a resource collection
        return $this->setCode(200)->setSuccess(true)->setMessage('ServicesService retrieved successfully.')
            ->setData([
                'services' => ServicesResource::collection($services),
            ])->send();
    }

}

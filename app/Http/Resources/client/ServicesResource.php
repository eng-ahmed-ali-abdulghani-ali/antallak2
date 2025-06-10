<?php

namespace App\Http\Resources\client;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image' => $this->getFirstMediaUrl(Service::COLLECTION_SERVICES_IMAGE),
        ];
    }
}

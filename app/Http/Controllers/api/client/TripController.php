<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\client\GetTripRequest;
use App\Services\api\client\TripService;

class TripController extends Controller
{
    public $trip;

    public function __construct(TripService $trip)
    {
        $this->trip = $trip;
    }

    public function getTrip(GetTripRequest $request)
    {
        return $this->trip->getTrip($request->validated());
    }

    public function acceptTrip()
    {
        return $this->trip->acceptTrip();

    }
}

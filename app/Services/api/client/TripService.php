<?php

namespace App\Services\api\client;

use App\Models\City;
use App\Models\CityTranslation;
use App\Models\PricingRule;
use App\Models\SystemSetting;
use App\Models\Trip;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TripService
{
    use ApiResponse;

    /**
     * Initiate a trip request to all nearby drivers.
     */
    public function getTrip(array $data)
    {
        // Get the authenticated user
        $client = Auth::user();

        // Ensure the authenticated user is a client
        if ($client->role !== 'client') {
            return $this->setCode(404)->setSuccess(false)->setMessage('No Client found.')->send();
        }

        $pickup_lat = $data['pickup_latitude'];
        $pickup_lng = $data['pickup_longitude'];

        // Get all drivers near the pickup location
        $nearbyDrivers = User::query()->nearbyDrivers($pickup_lat, $pickup_lng)->get();

        // Send trip request to each nearby driver
        foreach ($nearbyDrivers as $driver) {
            $this->sendTripRequest($driver, $client, $data);
        }

        // Return success response
        return $this->setCode(201)->setSuccess(true)->setMessage('Trip requests to drivers have been successfully sent.')->send();
    }

    /**
     * Send a trip request to a specific driver and create a trip record.
     */
    private function sendTripRequest($driver, $client, array $data)
    {
        // Extract trip and location data
        $service_id        = $data['service_id'];
        $category_id       = $data['category_id'];
        $payment_method_id = $data['payment_method_id'];
        $pickup_lat        = $data['pickup_latitude'];
        $pickup_lng        = $data['pickup_longitude'];
        $dropoff_lat       = $data['dropoff_latitude'];
        $dropoff_lng       = $data['dropoff_longitude'];
        $cit_name          = $data['cit_name'];

        // Calculate trip distance
        $distance = $this->getDistance($pickup_lat, $pickup_lng, $dropoff_lat, $dropoff_lng, 'km');

        // If you don't send it in the request, take it from here
       // $cityName = $this->getCityFromCoordinates($pickup_lat, $pickup_lng);

        // Normalize the Arabic city name for matching
        $cit_name = strtolower($cit_name); // Convert to lowercase
        $cit_name = preg_replace('/\s+/', '', $cit_name); // Remove all spaces


        // Get the city ID from city translations
        $city_id = CityTranslation::where('name', $cit_name)->first()?->city_id;

        if (!$city_id) {
            // If it is not available, we will calculate the price of Medina
            $city_id = CityTranslation::where('name', 'المدينةالمنورة')->first()?->city_id;

            // If it is not available,
            if (!$city_id) {
                throw new \Exception("City not found, including fallback.");
            }
        }



        // Get pricing rule and calculate total fare
        $pricing = $this->calcPricingRules($city_id, $category_id, $distance);

        // Get driver commission percent from system settings
        $commission_percent = SystemSetting::where('key', 'driver_commission_percentage_for_delivery')->value('value');

        // Create trip entry
        Trip::create([
            'service_id'               => $service_id,
            'client_id'                => $client->id,
            'driver_id'                => $driver->id,
            'payment_method_id'        => $payment_method_id,
            'category_id'              => $category_id,
            'pickup_latitude'          => $pickup_lat,
            'pickup_longitude'         => $pickup_lng,
            'dropoff_latitude'         => $dropoff_lat,
            'dropoff_longitude'        => $dropoff_lng,
            'estimated_duration'       => $driver->estimated_duration, // Approx. time to reach pickup
            'pricing_rule_id'          => $pricing['pricing_rule_id'],
            'total_amount'             => $pricing['total_amount'],
            'driver_commission_percent'=> $commission_percent,
            // start_time and end_time will be set later by the driver
        ]);


    }

    /**
     * Calculate distance using the Haversine formula (in kilometers or miles).
     */
    private function getDistance(float $lat1, float $lng1, float $lat2, float $lng2, string $unit = 'km'): float
    {
        $earthRadius = $unit === 'mi' ? 3958.8 : 6371; // Earth radius in miles or kilometers

        // Convert degrees to radians
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        // Haversine formula
        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;

        $a = sin($dLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 3); // Rounded to 3 decimal places
    }

    /**
     * Retrieve pricing rule and calculate trip cost.
     */
    private function calcPricingRules(int $city_id, int $category_id, float $distance): array
    {
        $pricingRule = PricingRule::where([
            ['city_id', '=', $city_id],
            ['category_id', '=', $category_id],
        ])->first();

        if (!$pricingRule) {
            throw new \Exception("Pricing rule not found for city_id: $city_id, category_id: $category_id");
        }

        // Calculate fare: base + (per km rate × distance)
        $total_amount = $pricingRule->base_fare + ($distance * $pricingRule->cost_per_km);

        // Ensure minimum fare
        if ($total_amount < $pricingRule->minimum_fare) {
            $total_amount = $pricingRule->minimum_fare;
        }

        return [
            'total_amount'    => $total_amount,
            'pricing_rule_id' => $pricingRule->id,
        ];
    }

    /**
     * Get the city name from latitude and longitude using Google Maps API.
     */
    private function getCityFromCoordinates(float $lat, float $lng): ?string
    {
        $apiKey = config('services.google_maps.key');

        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'latlng' => "$lat,$lng",
            'key'    => $apiKey,
        ]);

        if ($response->failed()) {
            return null;
        }

        $results = $response->json('results');

        if (empty($results)) {
            return null;
        }

        // Search for city/locality in address components
        foreach ($results[0]['address_components'] as $component) {
            if (in_array('locality', $component['types'])) {
                return $component['long_name'];
            }
        }

        return null; // City not found
    }

    /**
     * Accept trip functionality (to be implemented).
     */
    public function acceptTrip()
    {
        // Future implementation for accepting a trip
    }
}

<?php

namespace App\Services\api\client;

use App\Models\PricingRule;
use App\Models\SystemSetting;
use App\Models\Trip;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TripService
{
    use  ApiResponse;

    public function getTrip(array $data)
    {
        // Get the authenticated user
        $client = Auth::user();

        // Ensure the user is a client
        if ($client->role !== 'client') {
            return $this->setCode(404)->setSuccess(false)->setMessage('No Client found.')->send();
        }

        $pickup_lat = $data['pickup_latitude'];
        $pickup_lng = $data['pickup_longitude'];

        // Retrieve nearby drivers
        $nearbyDrivers = User::query()->nearbyDrivers($pickup_lat, $pickup_lng)->get();

        // Send trip request to each nearby driver
        foreach ($nearbyDrivers as $driver) {
            $this->sendTripRequest($driver, $client, $data);
        }
        // You can optionally return drivers or a summary here
        return $this->setCode(201)->setSuccess(true)->setMessage('Trip requests to drivers have been successfully sent.')->send();
    }

    /**
     * Send a trip request to a specific driver and create a trip record.
     */
    private function sendTripRequest($driver, $client, array $data)
    {
        $service_id = $data['service_id'];
        $category_id = $data['category_id'];
        $payment_method_id = $data['payment_method_id'];
        $pickup_lat = $data['pickup_latitude'];
        $pickup_lng = $data['pickup_longitude'];
        $dropoff_lat = $data['dropoff_latitude'];
        $dropoff_lng = $data['dropoff_longitude'];

        // Calculate the straight-line distance between pickup and dropoff
        $distance = $this->getDistance($pickup_lat, $pickup_lng, $dropoff_lat, $dropoff_lng, 'km');

        $cityName = $this->getCityFromCoordinates($pickup_lat, $pickup_lng);
        // TODO: Replace with actual logic to get city ID based on pickup location
        $city_id = 1;

        // Get pricing details using the applicable pricing rule
        $pricing = $this->calcPricingRules($city_id, $category_id, $distance);

        // Get driver commission percent from system settings
        $commission_percent = SystemSetting::where('key', 'driver_commission_percent')->value('value');

        // Create a new trip record
        Trip::create([
            'service_id' => $service_id,
            'client_id' => $client->id,
            'driver_id' => $driver->id,
            'payment_method_id' => $payment_method_id,
            'category_id' => $category_id,
            'pickup_latitude' => $pickup_lat,
            'pickup_longitude' => $pickup_lng,
            'dropoff_latitude' => $dropoff_lat,
            'dropoff_longitude' => $dropoff_lng,
            'estimated_duration' => $driver->estimated_duration, // distance from driver to pickup point
            'pricing_rule_id' => $pricing['pricing_rule_id'],
            'total_amount' => $pricing['total_amount'],
            'driver_commission_percent' => $commission_percent,
            // The following fields will be filled later by driver
            // 'start_time' => null,
            // 'end_time'   => null,
        ]);

    }

    /**
     * Calculate the distance between two geo-coordinates using the Haversine formula.
     */
    private function getDistance(float $lat1, float $lng1, float $lat2, float $lng2, string $unit = 'km'): float
    {
        $earthRadius = $unit === 'mi' ? 3958.8 : 6371; // Radius of Earth in mi or km

        // Convert degrees to radians
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        // Apply Haversine formula
        $dLat = $lat2 - $lat1;
        $dLng = $lng2 - $lng1;

        $a = sin($dLat / 2) ** 2 +
            cos($lat1) * cos($lat2) * sin($dLng / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 3); // Distance in chosen unit, rounded to 3 decimals
    }

    /**
     * Determine pricing rule and calculate trip total.
     */
    private function calcPricingRules(int $city_id, int $category_id, float $distance): array
    {
        // Fetch the applicable pricing rule
        $pricingRule = PricingRule::where([
            ['city_id', '=', $city_id],
            ['category_id', '=', $category_id],
        ])->first();

        if (!$pricingRule) {
            throw new \Exception("Pricing rule not found for city_id: $city_id, category_id: $category_id");
        }

        // Calculate total based on base fare + cost per km
        $total_amount = $pricingRule->base_fare + ($distance * $pricingRule->cost_per_km);

        // Apply minimum fare if calculated amount is below threshold
        if ($total_amount < $pricingRule->minimum_fare) {
            $total_amount = $pricingRule->minimum_fare;
        }

        return [
            'total_amount' => $total_amount,
            'pricing_rule_id' => $pricingRule->id,
        ];
    }



    private function getCityFromCoordinates(float $lat, float $lng): ?string
    {
        $apiKey = config('services.google_maps.key'); // Store this in your config/services.php

        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'latlng' => "$lat,$lng",
            'key' => $apiKey,
        ]);

        if ($response->failed()) {
            return null;
        }

        $results = $response->json('results');

        if (empty($results)) {
            return null;
        }

        // Look through the address components to find locality (city)
        foreach ($results[0]['address_components'] as $component) {
            if (in_array('locality', $component['types'])) {
                return $component['long_name'];
            }
        }

        return null; // If no city found
    }


    public function acceptTrip()
    {

    }
}

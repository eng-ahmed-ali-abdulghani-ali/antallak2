<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define services and their translations
        $services = [
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Ride'],
                    ['locale' => 'ar', 'name' => 'طلب سيارة'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Delivery'],
                    ['locale' => 'ar', 'name' => 'توصيل طلبات'],
                ],
            ],
        ];

        foreach ($services as $key => $serviceData) {
            // Create the main service record
            $service = Service::create();

            $service->addMediaFromUrl('https://picsum.photos/200?random=' . $key)
                ->toMediaCollection(Service::COLLECTION_SERVICES_IMAGE);

            // Create the translations for this service
            foreach ($serviceData['translations'] as $translation) {
                ServiceTranslation::create([
                    'service_id' => $service->id,
                    'locale'     => $translation['locale'],
                    'name'       => $translation['name'],
                ]);
            }
        }
    }
}

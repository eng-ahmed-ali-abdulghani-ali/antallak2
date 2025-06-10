<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{

    public function run(): void
    {


        $settings = [
            [
                'key' => 'driver_commission_percentage_for_delivery',
                'value' => 10,
                'type' => 'integer',
            ],
            [
                'key' => 'driver_commission_tiers_on_orders',
                'value' => [
                    'start_of_trip' => [
                        [
                            'distance_km' => 5,
                            'price' => 15,
                        ],
                    ],
                    'afterwards' => [
                        [
                            'distance_km' => 5,
                            'price' => 15,
                        ],
                    ],
                ],
                'type' => 'json',
            ],

        ];

        foreach ($settings as $setting) {
            // Use updateOrCreate to prevent duplicates and update existing settings

            SystemSetting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                ]
            );
        }


    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\PricingRule;
use Illuminate\Database\Seeder;

class PricingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingData = [
            [   // المدينة المنورة
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [ // الاقتصادية
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [ // العادية
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],

            [   // القصيم
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],

            [   // تبوك
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],

            [   // الجوف
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],

            [   // حائل
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],

            [   // الحدود الشمالية
                'city_id' => City::inRandomOrder()->value('id'),
                'pricing' => [
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 3.59,
                        'cost_per_km' => 0.99,
                        'cost_per_minute' => 0.22,
                        'minimum_fare' => 7.9
                    ],
                    [
                        'category_id' => Category::inRandomOrder()->value('id'),
                        'base_fare' => 4.19,
                        'cost_per_km' => 1.56,
                        'cost_per_minute' => 0.33,
                        'minimum_fare' => 11.8
                    ],
                ]
            ],
        ];

        foreach ($pricingData as $entry) {


            foreach ($entry['pricing'] as $rule) {


                PricingRule::create([
                    'city_id' => $entry['city_id'],
                    'category_id' => $rule['category_id'],
                    'base_fare' => $rule['base_fare'],
                    'cost_per_km' => $rule['cost_per_km'],
                    'cost_per_minute' => $rule['cost_per_minute'],
                    'minimum_fare' => $rule['minimum_fare'],
                    'start_time' => '00:00:00',
                    'end_time' => '23:59:59',
                    'days_of_week' => json_encode(['all']),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CityTranslation;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['en' => 'riyadh', 'ar' => 'الرياض'],
            ['en' => 'jeddah', 'ar' => 'جدة'],
            ['en' => 'mecca', 'ar' => 'مكة المكرمة'],
            ['en' => 'medina', 'ar' => 'المدينةالمنورة'],
            ['en' => 'dammam', 'ar' => 'الدمام'],
            ['en' => 'khobar', 'ar' => 'الخبر'],
            ['en' => 'abha', 'ar' => 'أبها'],
            ['en' => 'tabuk', 'ar' => 'تبوك'],
            ['en' => 'buraydah', 'ar' => 'بريدة'],
            ['en' => 'hail', 'ar' => 'حائل'],
            ['en' => 'najran', 'ar' => 'نجران'],
            ['en' => 'jazan', 'ar' => 'جازان'],
            ['en' => 'alBaha', 'ar' => 'الباحة'],
            ['en' => 'sakaka', 'ar' => 'سكاكا'],
            ['en' => 'yanbu', 'ar' => 'ينبع'],
        ];

        foreach ($cities as $key => $cityData) {
            $city = City::create();

            foreach (['en', 'ar'] as $locale) {
                CityTranslation::create([
                    'city_id' => $city->id,
                    'locale'  => $locale,
                    'name'    => $cityData[$locale],
                ]);
            }
        }
    }
}

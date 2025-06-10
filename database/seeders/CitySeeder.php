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
            ['en' => 'Riyadh', 'ar' => 'الرياض'],
            ['en' => 'Jeddah', 'ar' => 'جدة'],
            ['en' => 'Mecca', 'ar' => 'مكة المكرمة'],
            ['en' => 'Medina', 'ar' => 'المدينة المنورة'],
            ['en' => 'Dammam', 'ar' => 'الدمام'],
            ['en' => 'Khobar', 'ar' => 'الخبر'],
            ['en' => 'Abha', 'ar' => 'أبها'],
            ['en' => 'Tabuk', 'ar' => 'تبوك'],
            ['en' => 'Buraydah', 'ar' => 'بريدة'],
            ['en' => 'Hail', 'ar' => 'حائل'],
            ['en' => 'Najran', 'ar' => 'نجران'],
            ['en' => 'Jazan', 'ar' => 'جازان'],
            ['en' => 'Al Baha', 'ar' => 'الباحة'],
            ['en' => 'Sakaka', 'ar' => 'سكاكا'],
            ['en' => 'Yanbu', 'ar' => 'ينبع'],
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

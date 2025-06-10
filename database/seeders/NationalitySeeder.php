<?php

namespace Database\Seeders;

use App\Models\Nationality;
use App\Models\NationalityTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{

    public function run(): void
    {
        $nationalities = [
            ['en' => 'Saudi', 'ar' => 'السعودية'],
            ['en' => 'aibn muatana', 'ar' => 'ابن مواطنة'],
            ['en' => 'Egyptian', 'ar' => 'المصرية'],
            ['en' => 'Yemeni', 'ar' => 'اليمنية'],
            ['en' => 'Syrian', 'ar' => 'السورية'],
            ['en' => 'Sudanese', 'ar' => 'السودانية'],
            ['en' => 'Jordanian', 'ar' => 'الأردنية'],
            ['en' => 'Palestinian', 'ar' => 'الفلسطينية'],
            ['en' => 'Lebanese', 'ar' => 'اللبنانية'],
            ['en' => 'Pakistani', 'ar' => 'الباكستانية'],
            ['en' => 'Indian', 'ar' => 'الهندية'],
            ['en' => 'Bangladeshi', 'ar' => 'البنغلاديشية'],
            ['en' => 'Filipino', 'ar' => 'الفلبينية'],
            ['en' => 'Indonesian', 'ar' => 'الإندونيسية'],
            ['en' => 'Ethiopian', 'ar' => 'الإثيوبية'],
            ['en' => 'Somali', 'ar' => 'الصومالية'],
            ['en' => 'Turkish', 'ar' => 'التركية'],
            ['en' => 'Chadian', 'ar' => 'التشادية'],
            ['en' => 'Nigerian', 'ar' => 'النيجيرية'],
            ['en' => 'Afghan', 'ar' => 'الأفغانية'],
            ['en' => 'Nepalese', 'ar' => 'النيبالية'],
            ['en' => 'Sri Lankan', 'ar' => 'السريلانكية'],
            ['en' => 'Tunisian', 'ar' => 'التونسية'],
            ['en' => 'Algerian', 'ar' => 'الجزائرية'],
            ['en' => 'Moroccan', 'ar' => 'المغربية'],
            ['en' => 'Bahraini', 'ar' => 'البحرينية'],
            ['en' => 'Emirati', 'ar' => 'الإماراتية'],
            ['en' => 'Qatari', 'ar' => 'القطرية'],
            ['en' => 'Kuwaiti', 'ar' => 'الكويتية'],
            ['en' => 'Omani', 'ar' => 'العمانية'],
            ['en' => 'Libyan', 'ar' => 'الليبية'],
            ['en' => 'Eritrean', 'ar' => 'الإريترية'],
            ['en' => 'American', 'ar' => 'الأمريكية'],
            ['en' => 'British', 'ar' => 'البريطانية'],
            ['en' => 'French', 'ar' => 'الفرنسية'],
            ['en' => 'German', 'ar' => 'الألمانية'],
            ['en' => 'Canadian', 'ar' => 'الكندية'],
            ['en' => 'Chinese', 'ar' => 'الصينية'],
            ['en' => 'Malaysian', 'ar' => 'الماليزية'],
            ['en' => 'Thai', 'ar' => 'التايلاندية']
        ];



        foreach ($nationalities as $key => $nationalityData) {
            $nationality = Nationality::create();

            foreach (['en', 'ar'] as $locale) {
                NationalityTranslation::create([
                    'nationality_id' => $nationality->id,
                    'locale'  => $locale,
                    'name'    => $nationalityData[$locale],
                ]);
            }
        }
    }
}

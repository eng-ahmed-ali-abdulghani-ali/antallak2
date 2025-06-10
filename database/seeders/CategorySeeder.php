<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Economy'],
                    ['locale' => 'ar', 'name' => 'الاقتصادية'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Standard'],
                    ['locale' => 'ar', 'name' => 'العادية'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'V.I.P'],
                    ['locale' => 'ar', 'name' => 'V.I.P'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Family'],
                    ['locale' => 'ar', 'name' => 'العائلية'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Family VIP'],
                    ['locale' => 'ar', 'name' => 'العائلية VIP'],
                ],
            ],
        ];

        foreach ($translations as $key => $entry) {
            // إنشاء سجل الفئة الأساسي
            $category = Category::create();

            // رفع صورة عشوائية (أو يمكنك تعديل الرابط لاحقاً لصور حقيقية)
            $category->addMediaFromUrl('https://picsum.photos/200?random=' . $key)
                ->toMediaCollection(Category::COLLECTION_CATEGORIES_IMAGE);

            // إنشاء الترجمات الخاصة بالفئة
            foreach ($entry['translations'] as $translation) {
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'locale'      => $translation['locale'],
                    'name'        => $translation['name'],
                ]);
            }
        }
    }

}

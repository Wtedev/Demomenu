<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // المشروبات الساخنة (category_id: 1)
            [
                'name' => 'قهوة عربية',
                'name_en' => 'Arabic Coffee',
                'description' => 'قهوة عربية أصيلة محمصة طازجة',
                'price' => 15.00,
                'calories' => 5,
                'category_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=300&h=200&fit=crop',
                'is_featured' => true
            ],
            [
                'name' => 'شاي أحمر',
                'name_en' => 'Black Tea',
                'description' => 'شاي أحمر فاخر مع النعناع',
                'price' => 8.00,
                'calories' => 2,
                'category_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1556881286-2abb7fd4ac07?w=300&h=200&fit=crop'
            ],
            [
                'name' => 'كابتشينو',
                'name_en' => 'Cappuccino',
                'description' => 'كابتشينو إيطالي أصيل',
                'price' => 18.00,
                'original_price' => 22.00,
                'calories' => 150,
                'category_id' => 1,
                'image' => 'https://images.unsplash.com/photo-1572286258217-9bf07c7ad6d2?w=300&h=200&fit=crop'
            ],

            // المشروبات الباردة (category_id: 2)
            [
                'name' => 'عصير برتقال طازج',
                'name_en' => 'Fresh Orange Juice',
                'description' => 'عصير برتقال طبيعي 100%',
                'price' => 12.00,
                'calories' => 112,
                'category_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?w=300&h=200&fit=crop',
                'is_featured' => true
            ],
            [
                'name' => 'ليموناضة',
                'name_en' => 'Lemonade',
                'description' => 'ليموناضة طازجة بالنعناع',
                'price' => 10.00,
                'calories' => 70,
                'category_id' => 2,
                'image' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=300&h=200&fit=crop'
            ],

            // الوجبات الرئيسية (category_id: 3)
            [
                'name' => 'برجر لحم',
                'name_en' => 'Beef Burger',
                'description' => 'برجر لحم طازج مع الخضار والصوص الخاص',
                'price' => 35.00,
                'original_price' => 40.00,
                'calories' => 650,
                'category_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=200&fit=crop'
            ],
            [
                'name' => 'شاورما دجاج',
                'name_en' => 'Chicken Shawarma',
                'description' => 'شاورما دجاج مشوي مع الخضار والطحينة',
                'price' => 25.00,
                'calories' => 420,
                'category_id' => 3,
                'image' => 'https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=300&h=200&fit=crop',
                'is_featured' => true
            ],

            // المقبلات (category_id: 4)
            [
                'name' => 'حمص بالطحينة',
                'name_en' => 'Hummus',
                'description' => 'حمص طازج مع الطحينة وزيت الزيتون',
                'price' => 15.00,
                'calories' => 270,
                'category_id' => 4,
                'image' => 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=300&h=200&fit=crop'
            ],
            [
                'name' => 'فتوش',
                'name_en' => 'Fattoush',
                'description' => 'سلطة فتوش بالخضار الطازجة',
                'price' => 18.00,
                'calories' => 150,
                'category_id' => 4,
                'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300&h=200&fit=crop'
            ],

            // الحلويات (category_id: 5)
            [
                'name' => 'كنافة نابلسية',
                'name_en' => 'Knafeh',
                'description' => 'كنافة نابلسية أصيلة بالجبن',
                'price' => 20.00,
                'calories' => 380,
                'category_id' => 5,
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=200&fit=crop',
                'is_featured' => true
            ],
            [
                'name' => 'بقلاوة',
                'name_en' => 'Baklava',
                'description' => 'بقلاوة بالفستق والعسل',
                'price' => 12.00,
                'original_price' => 15.00,
                'calories' => 290,
                'category_id' => 5,
                'image' => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=300&h=200&fit=crop'
            ],

            // السلطات (category_id: 6)
            [
                'name' => 'سلطة يونانية',
                'name_en' => 'Greek Salad',
                'description' => 'سلطة يونانية بجبن الفيتا والزيتون',
                'price' => 22.00,
                'calories' => 200,
                'category_id' => 6,
                'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300&h=200&fit=crop'
            ],
            [
                'name' => 'تبولة',
                'name_en' => 'Tabbouleh',
                'description' => 'تبولة لبنانية بالبقدونس والطماطم',
                'price' => 16.00,
                'calories' => 120,
                'category_id' => 6,
                'image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=300&h=200&fit=crop'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'المشروبات الساخنة', 'name_en' => 'Hot Beverages', 'sort_order' => 1],
            ['name' => 'المشروبات الباردة', 'name_en' => 'Cold Beverages', 'sort_order' => 2],
            ['name' => 'الوجبات الرئيسية', 'name_en' => 'Main Dishes', 'sort_order' => 3],
            ['name' => 'المقبلات', 'name_en' => 'Appetizers', 'sort_order' => 4],
            ['name' => 'الحلويات', 'name_en' => 'Desserts', 'sort_order' => 5],
            ['name' => 'السلطات', 'name_en' => 'Salads', 'sort_order' => 6],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

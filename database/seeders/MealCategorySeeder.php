<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'All',
            'Ramen',
            'Maki',
            'Ala Carte',
            'Don Buri',
            'Wings Platter',
            'New Meals',
            'Sizzling Plates',
            'Pinoy Rice Plates',
            'Rice Feast',
            'Drinks',
            'Add Ons',
        ];
        foreach ($categories as $category) {
            DB::table('meal_categories')->insert([
                'category' => $category,
            ]);
        }
    }
}

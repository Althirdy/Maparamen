<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Dry',
            'Wet',
            'Sauces'
        ];
        foreach ($categories as $category) {
            DB::table('ingredient_categories')->insert([
                'category' => $category,
            ]);
        }
    }
}

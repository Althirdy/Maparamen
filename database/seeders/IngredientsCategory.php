<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsCategory extends Seeder
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
            DB::table('inventory_categories')->insert([
                'category' => $category
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            ['category_id' => '1', 'ingredient_name' => 'Aonori', 'quantity' => 23.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Benishoga', 'quantity' => 15.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/25/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Bell Pepper', 'quantity' => 8.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/14/2024', 'expiration_date' => '12/26/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Bread Crumbs', 'quantity' => 5.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/13/2024', 'expiration_date' => '12/27/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Cabbage', 'quantity' => 30.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/28/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Carrots', 'quantity' => 20.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/29/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Chili Powder', 'quantity' => 10.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/12/2024', 'expiration_date' => '12/20/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Coleslaw', 'quantity' => 12.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/22/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Eden Cheese', 'quantity' => 3.00, 'measurement' => 'pcs', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/26/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Egg', 'quantity' => 6.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/25/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Fried Leaks', 'quantity' => 18.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/15/2024', 'expiration_date' => '12/26/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Garlic', 'quantity' => 12.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/14/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Ginger', 'quantity' => 10.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/13/2024', 'expiration_date' => '12/22/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Ground Pepper', 'quantity' => 15.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/26/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Gyoza', 'quantity' => 5.00, 'measurement' => 'pcs',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Naruto', 'quantity' => 12.00, 'measurement' => 'slice',  'manufactured_date' => '12/14/2024', 'expiration_date' => '12/22/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Nori', 'quantity' => 7.00, 'measurement' => 'pcs', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/25/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Onion', 'quantity' => 20.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/25/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Onion Leeks', 'quantity' => 11.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/23/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Showa', 'quantity' => 25.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/14/2024', 'expiration_date' => '12/28/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Raddish', 'quantity' => 17.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/29/2024', 'delivery_date' => '12/18/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Tenkats', 'quantity' => 14.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/15/2024', 'expiration_date' => '12/22/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Wakami', 'quantity' => 12.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/14/2024', 'expiration_date' => '12/23/2024', 'delivery_date' => '12/16/2024'],
            ['category_id' => '1', 'ingredient_name' => 'Wasabi', 'quantity' => 8.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Japa Rice', 'quantity' => 6.00, 'measurement' => 'cup',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Chicken T Bone', 'quantity' => 12.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Dressing Mayo', 'quantity' => 27.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Pork Katsudon', 'quantity' => 10.00, 'measurement' => 'order', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Water', 'quantity' => 18.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Karaage D', 'quantity' => 5.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Pork Shogayaki', 'quantity' => 14.00, 'measurement' => 'order', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Beef Gyudon', 'quantity' => 7.00, 'measurement' => 'order',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Cooking Oil', 'quantity' => 22.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Yakisoba Noodles', 'quantity' => 3.00, 'measurement' => 'order',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Chasu Pork', 'quantity' => 20.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Mango', 'quantity' => 16.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Cucumber', 'quantity' => 11.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Ebico', 'quantity' => 6.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Maki Rice', 'quantity' => 19.00, 'measurement' => 'cup', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Pink Gari', 'quantity' => 23.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Mayo Orig', 'quantity' => 7.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'DM Ketchup', 'quantity' => 12.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Sesame Seed', 'quantity' => 18.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Fried Leeks', 'quantity' => 9.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Cream Cheese', 'quantity' => 5.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Tuna', 'quantity' => 14.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Sweet Mayo', 'quantity' => 20.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Geki Kara Paste', 'quantity' => 6.00, 'measurement' => 'tbsp',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Salmon', 'quantity' => 8.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Tantan Giniling', 'quantity' => 19.00, 'measurement' => '(g) grams', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Plain Giniling', 'quantity' => 25.00, 'measurement' => '(g) grams',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Shrimp', 'quantity' => 9.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Chasu', 'quantity' => 21.00, 'measurement' => 'pcs', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Tahong', 'quantity' => 10.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Squid', 'quantity' => 12.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Crabstick', 'quantity' => 8.00, 'measurement' => 'pcs',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Wantan', 'quantity' => 15.00, 'measurement' => 'pcs', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Lemon', 'quantity' => 5.00, 'measurement' => 'slice',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Rice', 'quantity' => 9.00, 'measurement' => 'cup',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Noodles', 'quantity' => 13.00, 'measurement' => 'order', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Water', 'quantity' => 23.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '2', 'ingredient_name' => 'Cooking Oil', 'quantity' => 16.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Teriyaki Sauce', 'quantity' => 13.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Katsudon Sauce', 'quantity' => 10.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Yakisoba Sauce', 'quantity' => 12.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Tempura Sauce', 'quantity' => 15.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Gyoza Sauce', 'quantity' => 20.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Spicy Maki Sauce', 'quantity' => 5.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Shio Sauce', 'quantity' => 12.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Tonkutsu Sauce', 'quantity' => 15.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Shoyu Sauce', 'quantity' => 13.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Tantanmen Sauce', 'quantity' => 10.00, 'measurement' => '(ml) milliliters',  'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024'],
            ['category_id' => '3', 'ingredient_name' => 'Shogayaki Sauce', 'quantity' => 12.00, 'measurement' => '(ml) milliliters', 'manufactured_date' => '12/16/2024', 'expiration_date' => '12/24/2024', 'delivery_date' => '12/17/2024']

        ];
        DB::table('ingredients')->insert($ingredients);

    }
}

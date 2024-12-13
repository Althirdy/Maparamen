<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meals = [
            //Ramen
            ['category_id' => '2', 'meal_name' => 'Mapa Ramen', 'meal_price' => 99.00, 'meal_image' => 'r_maparamen.png'],
            ['category_id' => '2', 'meal_name' => 'Shio', 'meal_price' => 139.00, 'meal_image' => 'r_shio.png'],
            ['category_id' => '2', 'meal_name' => 'Wantan Ramen', 'meal_price' => 149.00, 'meal_image' => 'r_wantan.png'],
            ['category_id' => '2', 'meal_name' => 'Shoyu', 'meal_price' => 149.00, 'meal_image' => 'r_shoyu.png'],
            ['category_id' => '2', 'meal_name' => 'Tonkotsu', 'meal_price' => 169.00, 'meal_image' => 'r_tonkotsu.png'],
            ['category_id' => '2', 'meal_name' => 'Miso Ramen', 'meal_price' => 179.00, 'meal_image' => 'r_miso.png'],
            ['category_id' => '2', 'meal_name' => 'Tantanmen', 'meal_price' => 189.00, 'meal_image' => 'r_tantanmen.png'],
            ['category_id' => '2', 'meal_name' => 'Beef Ramen', 'meal_price' => 189.00, 'meal_image' => 'r_beef.png'],
            ['category_id' => '2', 'meal_name' => 'Karamiso Ramen', 'meal_price' => 189.00, 'meal_image' => 'r_karamiso.png'],
            ['category_id' => '2', 'meal_name' => 'Seafood', 'meal_price' => 199.00, 'meal_image' => 'r_seafood.png'],
            //Maki
            ['category_id' => 3, 'meal_name' => 'Mapa Maki', 'meal_price' => 99.00, 'meal_image' => 'm_mapamaki.png'],
            ['category_id' => 3, 'meal_name' => 'Volcano', 'meal_price' => 199.00, 'meal_image' => 'm_volcano.png'],
            ['category_id' => 3, 'meal_name' => 'Cheezy Maki', 'meal_price' => 179.00, 'meal_image' => 'm_cheezy.png'],
            ['category_id' => 3, 'meal_name' => 'Spicy Maki', 'meal_price' => 159.00, 'meal_image' => 'm_spicy.png'],
            ['category_id' => 3, 'meal_name' => 'California', 'meal_price' => 139.00, 'meal_image' => 'm_california.png'],
            ['category_id' => 3, 'meal_name' => 'Fried Tuna Maki', 'meal_price' => 249.00, 'meal_image' => 'm_fried_tuna.png'],
            ['category_id' => 3, 'meal_name' => 'Spicy Salmon Maki', 'meal_price' => 249.00, 'meal_image' => 'm_spicy_salmon.png'],
            ['category_id' => 3, 'meal_name' => 'Spicy Tuna Maki', 'meal_price' => 249.00, 'meal_image' => 'm_spicy_tuna.png'],
            ['category_id' => 3, 'meal_name' => 'Salmon Roll Special', 'meal_price' => 249.00, 'meal_image' => 'm_salmon_roll.png'],
            ['category_id' => 3, 'meal_name' => 'Mapa Tuna Sashimi', 'meal_price' => 299.00, 'meal_image' => null],
            ['category_id' => 3, 'meal_name' => 'Mapa Mix Sushi', 'meal_price' => 249.00, 'meal_image' => null],
            ['category_id' => 3, 'meal_name' => 'Mapa Salmon Sashimi', 'meal_price' => 299.00, 'meal_image' => null],
            //Ala Carte
            ['category_id' => 4, 'meal_name' => 'T-Bone Steak', 'meal_price' => 249.00, 'meal_image' => 'ac_bone_steak.png'],
            ['category_id' => 4, 'meal_name' => 'Bagnet Sisig', 'meal_price' => 189.00, 'meal_image' => 'ac_bagnet_sisig.png'],
            ['category_id' => 4, 'meal_name' => 'Chicken Fillet', 'meal_price' => 189.00, 'meal_image' => 'ac_chicken_fillet.png'],
            ['category_id' => 4, 'meal_name' => 'Chicken Sisig', 'meal_price' => 189.00, 'meal_image' => 'ac_chicken_sisig.png'],
            ['category_id' => 4, 'meal_name' => 'Hungarian Sausage', 'meal_price' => 209.00, 'meal_image' => 'ac_hungarian.png'],
            //Don Buri
            ['category_id' => 5, 'meal_name' => 'Katsudon', 'meal_price' => 139.00, 'meal_image' => 'db_katsudon.png'],
            ['category_id' => 5, 'meal_name' => 'Chicken Teriyaki', 'meal_price' => 139.00, 'meal_image' => 'db_chicken_teriyaki.png'],
            ['category_id' => 5, 'meal_name' => 'Pork Shuga Yaki Don', 'meal_price' => 149.00, 'meal_image' => 'db_pork_shuga.png'],
            ['category_id' => 5, 'meal_name' => 'Karaage Don', 'meal_price' => 149.00, 'meal_image' => 'db_karaage.png'],
            ['category_id' => 5, 'meal_name' => 'Tempura Don', 'meal_price' => 169.00, 'meal_image' => 'db_tempura_don.png'],
            ['category_id' => 5, 'meal_name' => 'Beef Gyudon', 'meal_price' => 179.00, 'meal_image' => 'db_beef.png'],
            ['category_id' => 5, 'meal_name' => 'Tempura Ala Carte', 'meal_price' => 189.00, 'meal_image' => 'db_tempura_ac.png'],
            ['category_id' => 5, 'meal_name' => 'Gyoza', 'meal_price' => 189.00, 'meal_image' => 'db_gyoza.png'],
            ['category_id' => 5, 'meal_name' => 'Yakisoba', 'meal_price' => 189.00, 'meal_image' => 'db_yakisoba.png'],
            ['category_id' => 5, 'meal_name' => 'Kani Salad', 'meal_price' => 199.00, 'meal_image' => 'db_kani.png'],
            //wings platter
            ['category_id' => 6, 'meal_name' => 'Garlic Wings (6 pcs)', 'meal_price' => 179.00, 'meal_image' => 'wp_garlic_6.png'],
            ['category_id' => 6, 'meal_name' => 'Spicy Wings (6 pcs)', 'meal_price' => 179.00, 'meal_image' => 'wp_spicy_6.png'],
            ['category_id' => 6, 'meal_name' => 'Buttered Wings (6 pcs)', 'meal_price' => 179.00, 'meal_image' => 'wp_buttered_6.png'],
            ['category_id' => 6, 'meal_name' => 'Garlic Wings (12 pcs)', 'meal_price' => 349.00, 'meal_image' => 'wp_garlic_12.png'],
            ['category_id' => 6, 'meal_name' => 'Spicy Wings (12 pcs)', 'meal_price' => 349.00, 'meal_image' => 'wp_spicy_12.png'],
            ['category_id' => 6, 'meal_name' => 'Buttered Wings (12 pcs)', 'meal_price' => 349.00, 'meal_image' => 'wp_buttered_12.png'],
            ['category_id' => 6, 'meal_name' => 'Garlic Wings (18 pcs)', 'meal_price' => 519.00, 'meal_image' => 'wp_garlic_18.png'],
            ['category_id' => 6, 'meal_name' => 'Spicy Wings (18 pcs)', 'meal_price' => 519.00, 'meal_image' => 'wp_spicy_18.png'],
            ['category_id' => 6, 'meal_name' => 'Buttered Wings (18 pcs)', 'meal_price' => 519.00, 'meal_image' => 'wp_buttered_18.png'],
            //New Meals
            ['category_id' => 7, 'meal_name' => 'Katsu Curry Don', 'meal_price' => 209.00, 'meal_image' => 'nm_katsu_curry.png'],
            ['category_id' => 7, 'meal_name' => 'Tori Curry Rice', 'meal_price' => 199.00, 'meal_image' => 'nm_tori_curry.png'],
            ['category_id' => 7, 'meal_name' => 'Karubi Ramen', 'meal_price' => 199.00, 'meal_image' => 'nm_karubi.png'],
            ['category_id' => 7, 'meal_name' => 'Karaage Ramen', 'meal_price' => 179.00, 'meal_image' => 'nm_karaage.png'],
            ['category_id' => 7, 'meal_name' => 'Kushiage Don', 'meal_price' => 149.00, 'meal_image' => 'nm_kushiage.png'],
            ['category_id' => 7, 'meal_name' => 'Yaki Tori Don', 'meal_price' => 149.00, 'meal_image' => 'nm_yaki_tori.png'],
            ['category_id' => 7, 'meal_name' => 'Chahan Gyoza', 'meal_price' => 129.00, 'meal_image' => 'nm_chahan.png'],
            ['category_id' => 7, 'meal_name' => 'Kani Chahan', 'meal_price' => 69.00, 'meal_image' => 'nm_kani.png'],
            ['category_id' => 7, 'meal_name' => 'Chahan', 'meal_price' => 59.00, 'meal_image' => 'nm_chahan.png'],
            //Sizzling plate
            ['category_id' => 8, 'meal_name' => 'T-Bone Steak', 'meal_price' => 169.00, 'meal_image' => 'sp_bone.png'],
            ['category_id' => 8, 'meal_name' => 'Bagnet Sisig', 'meal_price' => 119.00, 'meal_image' => 'sp_bagnet.png'],
            ['category_id' => 8, 'meal_name' => 'Chicken Fillet', 'meal_price' => 119.00, 'meal_image' => 'sp_chicken_fillet.png'],
            ['category_id' => 8, 'meal_name' => 'Chicken Sisig', 'meal_price' => 119.00, 'meal_image' => 'sp_chicken_sisig.png'],
            ['category_id' => 8, 'meal_name' => 'Hungarian Sausage', 'meal_price' => 109.00, 'meal_image' => 'sp_hungarian.png'],
            //Pinoy Rice Plates
            ['category_id' => 9, 'meal_name' => 'Bulalo', 'meal_price' => 169.00, 'meal_image' => 'pr_bulalo.png'],
            ['category_id' => 9, 'meal_name' => 'Crispy Pata', 'meal_price' => 119.00, 'meal_image' => 'pr_crispy_pata.png'],
            ['category_id' => 9, 'meal_name' => 'Fries', 'meal_price' => 119.00, 'meal_image' => 'pr_fries.png'],
            //Rice Feast
            ['category_id' => 10, 'meal_name' => 'Plain Rice', 'meal_price' => 99.00, 'meal_image' => 'r_plain.png'],
            ['category_id' => 10, 'meal_name' => 'Garlic Rice', 'meal_price' => 149.00, 'meal_image' => 'r_garlic.png'],
            ['category_id' => 10, 'meal_name' => 'Yang Chow', 'meal_price' => 199.00, 'meal_image' => 'r_yang.png'],
            //Drinks
            ['category_id' => 11, 'meal_name' => 'Red Tea Pitcher', 'meal_price' => 60.00, 'meal_image' => 'd_tea_pitcher.png'],
            ['category_id' => 11, 'meal_name' => 'Coke Mismo', 'meal_price' => 25.00, 'meal_image' => 'd_coke_mismo.png'],
            ['category_id' => 11, 'meal_name' => 'Royal Mismo', 'meal_price' => 25.00, 'meal_image' => 'd_royal_mismo.png'],
            ['category_id' => 11, 'meal_name' => 'Sprite Mismo', 'meal_price' => 25.00, 'meal_image' => 'd_sprite_mismo.png'],
            ['category_id' => 11, 'meal_name' => 'Mountain Dew', 'meal_price' => 25.00, 'meal_image' => 'd_mountain.png'],
            ['category_id' => 11, 'meal_name' => 'Bottled Water', 'meal_price' => 20.00, 'meal_image' => 'd_water.png'],
            ['category_id' => 11, 'meal_name' => 'Coke 1.5L', 'meal_price' => 100.00, 'meal_image' => 'd_coke.png'],
            ['category_id' => 11, 'meal_name' => 'Red Tea Solo', 'meal_price' => 20.00, 'meal_image' => 'd_tea_solo.png'],
            //drinks
            ['category_id' => 12, 'meal_name' => 'Extra Chasu', 'meal_price' => 30.00, 'meal_image' => 'ad_chasu.png'],
            ['category_id' => 12, 'meal_name' => 'Japanese Kimchi', 'meal_price' => 50.00, 'meal_image' => 'ad_kimchi.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Noodles', 'meal_price' => 30.00, 'meal_image' => 'ad_noodles.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Japanese Rice', 'meal_price' => 30.00, 'meal_image' => 'ad_japanese_rice.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Soup', 'meal_price' => 30.00, 'meal_image' => 'ad_soup.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Rice', 'meal_price' => 25.00, 'meal_image' => 'ad_rice.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Bagoong', 'meal_price' => 15.00, 'meal_image' => 'ad_bagoong.png'],
            ['category_id' => 12, 'meal_name' => 'Extra Egg', 'meal_price' => 25.00, 'meal_image' => 'ad_egg.png'],
        ];

        DB::table('meals')->insert($meals);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_array = [
            "Italiano",
            "Cinese",
            "Giapponese",
            "Indiano",
            "Fusion",
            "Hamburger",
            "Pizza",
            "Kebab",
            "Greco",
            "Thailandese"
        ];

        for ($i=0; $i < count($categories_array) ; $i++) {
            $new_category = new Category();
            $new_category->name = $categories_array[$i];
            $new_category->save();
        }
    }
}

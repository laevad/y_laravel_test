<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $mockRecipes = [];
        for ($i = 1; $i <= 100; $i++) {
            array_push($mockRecipes, array(
                "id" => (string) Str::uuid(),
                "name" => "Recipe " . $i,
                "user_id" => "cc8c06dd-502d-4550-9b6c-279b3b5e530a",
                "category_id" => "main-dish"
            ));
        }
        DB::table('recipes')->insert($mockRecipes);
    }
}

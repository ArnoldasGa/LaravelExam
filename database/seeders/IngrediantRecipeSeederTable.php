<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngrediantRecipeSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($id = 1; $id < 103; $id++){
            for ($i = 0; $i < 3; $i++){
                DB::table('ingredient_recipe')->insert([
                    'recipe_id' => $id,
                    'ingredient_id' => rand(1, 20)
                ]); 
            }
        };
    }
}

<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [[
            'name' => 'Easy chocolate fudge cake',
            'category_id' => 1,
            'description' => "Need a guaranteed crowd-pleasing cake that's easy to make? This super-squidgy chocolate fudge cake with smooth icing is an instant baking win",
            'is_active' => 1,
        ],
        [
            'name' => 'Chorizo & mozzarella gnocchi bake',
            'category_id' => 2,
            'description' => "Upgrade cheesy tomato pasta with gnocchi, chorizo and mozzarella for a comforting bake that makes an excellent midweek meal",
            'is_active' => 1
        ],
        [
            'name' => 'Easy chicken fajitas',
            'category_id' => 3,
            'description' => 'Need a simple, vibrant midweek meal the family will love? Put together these easy chicken fajitas and people can create their own masterpieces at the table',
            'is_active' => 0,
        ]];

        foreach($recipes as $recipe){
            Recipe::create($recipe);
        }

        Recipe::factory(100)->create();
    }
}

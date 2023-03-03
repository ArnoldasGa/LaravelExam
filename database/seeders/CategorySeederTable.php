<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Dessert',
            'is_active' => 1,
        ]);
        Category::create([
            'name' => 'Cheese',
            'is_active' => 1,
        ]);
        Category::create([
            'name' => 'Chicken',
            'is_active' => 0,
        ]);
    }
}

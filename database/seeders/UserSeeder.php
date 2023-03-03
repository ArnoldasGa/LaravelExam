<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'testas1@gmail.com',
            'password' => Hash::make('testas1'),
            'name' => 'Admin',
            'auth' => 'ADMIN'
            ]
        );
        for ($i = 2; $i < 30; $i++) {
            User::factory(1)->create(
                ['email' => 'testas' . $i . '@gmail.com', 'password' => Hash::make('testas' . $i)]
            );
        }
    }
}

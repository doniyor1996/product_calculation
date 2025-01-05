<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => 1,
            'name' => 'demo',
            'email' => 'demo@example.com',
            'password' => Hash::make('demo'),
        ]);

        Category::factory()
            ->count(5)
            ->has(Material::factory()->count(5))
            ->create();

        User::factory()->create([
            'id' => 2,
            'name' => 'demo 2',
            'email' => 'demo2@example.com',
            'password' => Hash::make('demo'),
        ]);
    }
}

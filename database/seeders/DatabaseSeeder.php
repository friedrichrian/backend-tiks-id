<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed movies, genres, and theaters
        $this->call([
            MoviesTableSeeder::class,
            TheaterTableSeeder::class,
        ]);

        // Create a test user
        // User::factory(10)->create();

        User::factory()->create([
            'fullname' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

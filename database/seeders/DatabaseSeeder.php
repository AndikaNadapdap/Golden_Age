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
        // Buat admin terlebih dahulu
        $this->call([
            AdminSeeder::class,
        ]);

        // Buat user dokter dan orang tua
        $this->call([
            UserSeeder::class,
        ]);

        // Seed data lainnya
        $this->call([
            ArticleSeeder::class,
            RecipeSeeder::class,
            StimulationSeeder::class,
            MilestoneSeeder::class,
            DiscussionSeeder::class,
        ]);
    }
}

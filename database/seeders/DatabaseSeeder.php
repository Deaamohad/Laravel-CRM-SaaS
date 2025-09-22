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
        // Create test users first
        User::factory(5)->create();

        // Create demo users with preset credentials
        $this->call([
            UsersTableSeeder::class,
        ]);

        // Then seed other models with relationships
        $this->call([
            CompanySeeder::class,
            DealSeeder::class,
            InteractionSeeder::class,
        ]);
    }
}

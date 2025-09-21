<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $companies = \App\Models\Company::all();

        foreach ($companies as $company) {
            // Create 2-5 contacts per company
            $contactCount = rand(2, 5);
            
            for ($i = 0; $i < $contactCount; $i++) {
                \App\Models\Contact::create([
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone' => fake()->phoneNumber(),
                    'position' => fake()->jobTitle(),
                    'notes' => fake()->sentence(),
                    'company_id' => $company->id,
                    'user_id' => $users->random()->id, // Random user who created this contact
                ]);
            }
        }
    }
}

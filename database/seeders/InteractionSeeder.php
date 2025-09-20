<?php

namespace Database\Seeders;

use App\Models\Interaction;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $users = User::all();
        
        // Create 100 interactions with relationships assigned during creation
        Interaction::factory(100)->make()->each(function ($interaction) use ($companies, $users) {
            $interaction->company_id = $companies->random()->id;
            $interaction->user_id = $users->random()->id;
            $interaction->save();
        });
    }
}

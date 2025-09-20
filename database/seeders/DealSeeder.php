<?php

namespace Database\Seeders;

use App\Models\Deal;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $users = User::all();
        
        // Create 50 deals with relationships assigned during creation
        Deal::factory(50)->make()->each(function ($deal) use ($companies, $users) {
            $deal->company_id = $companies->random()->id;
            $deal->user_id = $users->random()->id;
            $deal->save();
        });
    }
}

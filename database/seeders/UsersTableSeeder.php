<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@cliento.com',
            'password' => Hash::make('password'),
            'job_title' => 'CRM Administrator',
            'phone' => '(555) 123-4567',
        ]);
        
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@cliento.com',
            'password' => Hash::make('password'),
            'job_title' => 'System Administrator',
            'phone' => '(555) 987-6543',
        ]);
    }
}
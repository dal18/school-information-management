<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (!User::where('email', 'admin@lfhs.edu')->exists()) {
            User::create([
                'user_name' => 'admin',
                'first_name' => 'System',
                'middle_name' => '',
                'midle_name' => '', // Database typo
                'last_name' => 'Administrator',
                'email' => 'admin@lfhs.edu',
                'password' => Hash::make('password'),
                'access_rights' => 'Admin',
                'is_active' => true,
                'email_verified' => true,
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@lfhs.edu');
            $this->command->info('Password: password');
        } else {
            $this->command->warn('Admin user already exists.');
        }
    }
}

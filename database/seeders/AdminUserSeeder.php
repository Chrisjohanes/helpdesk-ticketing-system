<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin / IT Support User
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'it_support'
            ]
        );

        // Normal User (customer)
        User::updateOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'User',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ]
        );
    }
}
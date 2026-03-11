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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
        ]);

         // Normal User (customer)
        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}
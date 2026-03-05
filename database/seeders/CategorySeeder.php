<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Hardware'],
            ['name' => 'Software'],
            ['name' => 'Network'],
            ['name' => 'Access Request'],
        ]);
    }
}
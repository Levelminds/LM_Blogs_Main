<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Latest Articles', 'slug' => 'latest-articles', 'accent_color' => '#3248ad'],
            ['name' => "From Leader's Desk", 'slug' => 'from-leaders-desk', 'accent_color' => '#2a3c90'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug'] ?? \Illuminate\Support\Str::slug($category['name'])],
                $category
            );
        }
    }
}

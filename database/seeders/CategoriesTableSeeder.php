<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Video game',
            'Movie',
            'Music',
            'Documentary',
        ];
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}

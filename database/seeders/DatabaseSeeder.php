<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'is_active' => 1,
            'role_id' => 1,
            'name' => 'Chris Redfield',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);


        $this->call(CategoriesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        User::factory(10)->create();
        Post::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(!User::where('name', 'admin')->exists()){
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@keytify.com',
                'isAdmin' => 1,
                'password' => 'admin'
            ]);

            User::factory()->create([
                'name' => 'Glarses',
                'email' => 'glarses@gmail.com',
                'isAdmin' => 0,
                'password' => 'glarses'
            ]);

            User::factory()->create([
                'name' => 'Squashy',
                'email' => 'squashy@gmail.com',
                'isAdmin' => 0,
                'password' => 'squashy'
            ]);

            User::factory()->create([
                'name' => 'Hipyo',
                'email' => 'hipyo@gmail.com',
                'isAdmin' => 0,
                'password' => 'hipyo'
            ]);
        }

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ItemSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}

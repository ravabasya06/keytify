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
                'email' => 'admin@ecommerce.mail',
                'isAdmin' => 1,
                'password' => 'admin'
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

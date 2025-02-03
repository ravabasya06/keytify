<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Brand::where('slug', 'akko')->exists()){
            $brands = [
                ['name' => 'Akko', 'slug' => 'akko', 'desc' => 'Popular keyboard brand with vibrant designs.', 'image_url' => 'brands/akko.jpg'],
                ['name' => 'Keychron', 'slug' => 'keychron', 'desc' => 'Keyboards for professionals and enthusiasts.', 'image_url' => 'brands/keychron.jpg'],
                ['name' => 'Gateron', 'slug' => 'gateron', 'desc' => 'Smooth and reliable mechanical switches.', 'image_url' => 'brands/gateron.jpg'],
            ];

            foreach ($brands as $brand) {
                Brand::create($brand);
            }
        }
    }
}

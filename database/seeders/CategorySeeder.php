<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Category::where('slug', 'keyboards')->exists()){
            $categories = [
                ['name' => 'Keyboards', 'slug' => 'keyboards', 'desc' => 'Mechanical keyboards of all sizes.', 'image_url' => 'categories/keyboards.jpg'],
                ['name' => 'Switches', 'slug' => 'switches', 'desc' => 'Various types of mechanical switches.', 'image_url' => 'categories/switches.jpg'],
                ['name' => 'PCBs', 'slug' => 'pcbs', 'desc' => 'Printed circuit boards for custom keyboards.', 'image_url' => 'categories/pcbs.jpg'],
            ];

            foreach ($categories as $category) {
                Category::create($category);
            }
        }
    }

}


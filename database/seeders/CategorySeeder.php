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
        if (!Category::where('slug', 'keyboards')->exists()) {
            $categories = [
                ['name' => 'Keyboards', 'slug' => 'keyboards', 'desc' => 'Mechanical keyboards of all sizes.', 'image_url' => 'categories/keyboards.jpg'],
                ['name' => 'Switches', 'slug' => 'switches', 'desc' => 'Various types of mechanical switches.', 'image_url' => 'categories/switches.jpg'],
                ['name' => 'PCBs', 'slug' => 'pcbs', 'desc' => 'Printed circuit boards for custom keyboards.', 'image_url' => 'categories/pcbs.jpg'],
                ['name' => 'Keycaps', 'slug' => 'keycaps', 'desc' => 'Custom keycaps in various profiles and materials.', 'image_url' => 'categories/keycaps.jpg'],
                ['name' => 'Barebones', 'slug' => 'barebones', 'desc' => 'Keyboard kits without switches and keycaps.', 'image_url' => 'categories/barebones.jpg'],
                ['name' => 'Stabilizers', 'slug' => 'stabilizers', 'desc' => 'Essential stabilizers for larger keys like spacebar and shift.', 'image_url' => 'categories/stabilizers.jpg'],
                ['name' => 'Cases', 'slug' => 'cases', 'desc' => 'Keyboard cases in different materials like aluminum, plastic, and wood.', 'image_url' => 'categories/cases.jpg'],
                ['name' => 'Plates', 'slug' => 'plates', 'desc' => 'Metal and polycarbonate plates for mounting switches.', 'image_url' => 'categories/plates.jpg'],
                ['name' => 'Foam & Dampening', 'slug' => 'foam-dampening', 'desc' => 'Foam kits and dampeners to improve keyboard acoustics.', 'image_url' => 'categories/foam-dampening.jpg'],
                ['name' => 'Cables', 'slug' => 'cables', 'desc' => 'Custom coiled and straight cables for keyboards.', 'image_url' => 'categories/cables.jpg'],
                ['name' => 'Lubricants', 'slug' => 'lubricants', 'desc' => 'Lubricants for smooth switch and stabilizer performance.', 'image_url' => 'categories/lubricants.jpg'],
                ['name' => 'Tools', 'slug' => 'tools', 'desc' => 'Essential tools for keyboard assembly and maintenance.', 'image_url' => 'categories/tools.jpg'],
                ['name' => 'Deskmats', 'slug' => 'deskmats', 'desc' => 'Large mousepads designed for keyboard and mouse use.', 'image_url' => 'categories/deskmats.jpg'],
            ];
        
            foreach ($categories as $category) {
                Category::create($category);
            }
        }        
    }

}


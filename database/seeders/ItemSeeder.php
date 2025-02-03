<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Item::where('slug', 'purple-boom-v1')->exists()){
            $items = [
                [
                    'name' => 'Blacky 2.0',
                    'slug' => 'blacky-2.0',
                    'category_id' => 1, // Keyboards
                    'brand_id' => null,
                    'type' => '65%',
                    'stock' => 43,
                    'price' => 1399999,
                    'short_desc' => 'Amazing Keyboard with Soft Sound Profile',
                    'desc' => null,
                    'image_url' => 'https://www.alexotos.com/wp-content/uploads/2023/01/DSCF1747-1400x933.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
                [
                    'name' => 'Purple Boom V1',
                    'slug' => 'purple-boom-v1',
                    'category_id' => 1, // Keyboards
                    'brand_id' => null,
                    'type' => 'TKL',
                    'stock' => 30,
                    'price' => 1899999,
                    'short_desc' => "Clackiest Keyboard You'll Ever Hear",
                    'desc' => null,
                    'image_url' => 'https://www.alexotos.com/wp-content/uploads/2024/02/DSCF0948-1536x2048.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
                [
                    'name' => 'Whitey 4Z',
                    'slug' => 'whitey-4z',
                    'category_id' => 1,
                    'brand_id' => null, 
                    'type' => '75%',
                    'stock' => 15,
                    'price' => 899999,
                    'short_desc' => 'Affordable, Clean, and Beautiful Poppy Keyboard',
                    'desc' => null,
                    'image_url' => 'https://www.alexotos.com/wp-content/uploads/2024/02/SONNET_0169-Edit-2-1536x2048.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
                [
                    'name' => 'Gateron Yellow',
                    'slug' => 'gateron-yellow',
                    'category_id' => 2, // Keyboards
                    'brand_id' => 3,
                    'type' => 'Linear',
                    'stock' => 200,
                    'price' => 5000,
                    'short_desc' => 'Soft Switch',
                    'desc' => null,
                    'image_url' => 'https://www.alexotos.com/wp-content/uploads/2025/01/milky-yellow.jpg',
                    'status' => 1,
                    'featured' => 0,
                ],
            ];

            foreach ($items as $item) {
                Item::create($item);
            }
        }
    }
}

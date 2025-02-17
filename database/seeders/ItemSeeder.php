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
                    'name' => 'Akko MOD007 V3',
                    'slug' => 'mod007-v3',
                    'category_id' => 1, // Keyboards
                    'brand_id' => 1, // Akko
                    'type' => '75%',
                    'stock' => 25,
                    'price' => 1599999,
                    'short_desc' => 'A solid 75% gasket-mounted keyboard with aluminum case.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
                [
                    'name' => 'Akko CS Silver Switches',
                    'slug' => 'akko-cs-silver',
                    'category_id' => 2, // Switches
                    'brand_id' => 1,
                    'type' => 'Linear',
                    'stock' => 200,
                    'price' => 4000,
                    'short_desc' => 'Smooth linear switches with short actuation distance.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 0,
                ],
        
                // Keychron Keyboards
                [
                    'name' => 'Keychron Q1 Pro',
                    'slug' => 'keychron-q1-pro',
                    'category_id' => 1,
                    'brand_id' => 2, // Keychron
                    'type' => '75%',
                    'stock' => 40,
                    'price' => 1999999,
                    'short_desc' => 'Wireless mechanical keyboard with CNC aluminum frame and hot-swappable PCB.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Gateron Switches
                [
                    'name' => 'Gateron Milky Yellow',
                    'slug' => 'gateron-milky-yellow',
                    'category_id' => 2,
                    'brand_id' => 3, // Gateron
                    'type' => 'Linear',
                    'stock' => 300,
                    'price' => 5000,
                    'short_desc' => 'Smooth linear switch with a soft, satisfying bottom-out.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // GMK Keycap Sets
                [
                    'name' => 'GMK Red Samurai Keycaps',
                    'slug' => 'gmk-red-samurai',
                    'category_id' => 3,
                    'brand_id' => 6, // GMK
                    'type' => 'ABS Double-shot',
                    'stock' => 20,
                    'price' => 1199999,
                    'short_desc' => 'A premium keycap set with deep red and gold accents, inspired by samurai armor.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Epomaker Keyboards
                [
                    'name' => 'Epomaker TH80 Pro',
                    'slug' => 'epomaker-th80-pro',
                    'category_id' => 1,
                    'brand_id' => 7, // Epomaker
                    'type' => '80%',
                    'stock' => 20,
                    'price' => 1299999,
                    'short_desc' => 'A hot-swappable wireless keyboard with vibrant RGB and gasket mount.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Ajazz Keyboards
                [
                    'name' => 'Ajazz AC067',
                    'slug' => 'ajazz-ac067',
                    'category_id' => 1,
                    'brand_id' => 9, // Ajazz
                    'type' => '65%',
                    'stock' => 25,
                    'price' => 899999,
                    'short_desc' => 'Compact and stylish keyboard with a premium build.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Cidoo Keyboards
                [
                    'name' => 'Cidoo V65',
                    'slug' => 'cidoo-v65',
                    'category_id' => 1,
                    'brand_id' => 11, // Cidoo
                    'type' => '65%',
                    'stock' => 30,
                    'price' => 1299999,
                    'short_desc' => 'A gasket-mounted keyboard with a high-quality aluminum case.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
                [
                    'name' => 'Wuque Studio Ikki68 Aurora',
                    'slug' => 'wuque-ikki68-aurora',
                    'category_id' => 1,
                    'brand_id' => 8, // Wuque Studio
                    'type' => '65%',
                    'stock' => 20,
                    'price' => 1599999,
                    'short_desc' => 'A high-quality 65% keyboard with a customizable silicone dampener system.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // GMK Keycap Sets
                [
                    'name' => 'GMK Olivia Keycap Set',
                    'slug' => 'gmk-olivia',
                    'category_id' => 3,
                    'brand_id' => 6, // GMK
                    'type' => 'ABS Double-shot',
                    'stock' => 15,
                    'price' => 1399999,
                    'short_desc' => 'Elegant pink and black keycaps with a luxurious feel.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Cidoo Barebone Keyboards
                [
                    'name' => 'Cidoo V87 Barebone',
                    'slug' => 'cidoo-v87',
                    'category_id' => 4,
                    'brand_id' => 11, // Cidoo
                    'type' => 'TKL',
                    'stock' => 10,
                    'price' => 1099999,
                    'short_desc' => 'A Tenkeyless gasket-mounted keyboard barebone kit with vibrant RGB.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Epomaker PCBs
                [
                    'name' => 'Epomaker GK61 PCB',
                    'slug' => 'epomaker-gk61-pcb',
                    'category_id' => 5,
                    'brand_id' => 7, // Epomaker
                    'type' => '60% Hot-swappable PCB',
                    'stock' => 50,
                    'price' => 499999,
                    'short_desc' => 'A 60% hot-swappable PCB with per-key RGB and USB-C connectivity.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Cherry Switches
                [
                    'name' => 'Cherry MX Black Hyperglide',
                    'slug' => 'cherry-mx-black-hyperglide',
                    'category_id' => 2,
                    'brand_id' => 12, // Cherry
                    'type' => 'Linear',
                    'stock' => 500,
                    'price' => 6000,
                    'short_desc' => 'A legendary switch with a deep and smooth keystroke experience.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 0,
                ],
        
                // Ajazz Keyboards
                [
                    'name' => 'Ajazz K620T',
                    'slug' => 'ajazz-k620t',
                    'category_id' => 1,
                    'brand_id' => 9, // Ajazz
                    'type' => '60%',
                    'stock' => 30,
                    'price' => 799999,
                    'short_desc' => 'Compact Bluetooth keyboard with a built-in tablet stand.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Keychron Accessories
                [
                    'name' => 'Keychron Q3 Palm Rest',
                    'slug' => 'keychron-q3-palm-rest',
                    'category_id' => 6,
                    'brand_id' => 2, // Keychron
                    'type' => 'Wooden Palm Rest',
                    'stock' => 20,
                    'price' => 299999,
                    'short_desc' => 'A high-quality wooden palm rest designed for Keychron Q3.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // NovelKeys Deskmat
                [
                    'name' => 'NovelKeys Vaporwave Deskmat',
                    'slug' => 'novelkeys-vaporwave',
                    'category_id' => 7,
                    'brand_id' => 5, // NovelKeys
                    'type' => '900x400mm Deskmat',
                    'stock' => 35,
                    'price' => 399999,
                    'short_desc' => 'A stylish vaporwave-themed deskmat with a smooth surface.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // Wuque Studio Custom Kits
                [
                    'name' => 'Wuque Studio Mammoth75',
                    'slug' => 'wuque-mammoth75',
                    'category_id' => 4,
                    'brand_id' => 8, // Wuque Studio
                    'type' => '75% Barebone Kit',
                    'stock' => 15,
                    'price' => 2499999,
                    'short_desc' => 'Premium gasket-mounted 75% keyboard kit with an FR4 plate.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
        
                // KBDfans Accessories
                [
                    'name' => 'KBDfans Polycarbonate Plate for Tofu65',
                    'slug' => 'kbdfans-polycarb-plate-tofu65',
                    'category_id' => 6,
                    'brand_id' => 4, // KBDfans
                    'type' => '65% Keyboard Plate',
                    'stock' => 20,
                    'price' => 349999,
                    'short_desc' => 'A polycarbonate plate for a softer and deeper sound profile in Tofu65.',
                    'desc' => null,
                    'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg',
                    'status' => 1,
                    'featured' => 1,
                ],
            ];

            foreach ($items as $item) {
                Item::create($item);
            }
        }
    }
}

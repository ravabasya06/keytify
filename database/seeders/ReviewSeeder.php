<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Review::where('name', 'Glarses')->exists()){
            $reviews = [
                [
                    'name' => 'Glarses',
                    'desc' => 'Keytify offers some of the best customer service I have ever experienced. Their response times are incredibly fast, interactive, and genuinely helpful!',
                    'image_url' => 'https://yt3.googleusercontent.com/ytc/AIdro_lu7cLnCLYpj5hdW6889KSFa0rfmZfuLLQJ6Gz0dOW3ug=s160-c-k-c0x00ffffff-no-rj',
                    'rating' => 4,

                ],
                [
                    'name' => 'Squashy',
                    'desc' => 'An amazing selection of products with so many keyboard variations! I can find almost everything I need for my setup here.',
                    'image_url' => 'https://yt3.googleusercontent.com/5XzZ4fPgflnzZ79xnC1EQ0gi2XeHy3L8u2HZUbWsxwkNX5BpNbUy9hhn4nFcV9VdWmfviZNFv08=s160-c-k-c0x00ffffff-no-rj',
                    'rating' => 5,
                ],
                [
                    'name' => 'Hipyo',
                    'desc' => 'Outstanding service and an incredible range of products. Keytify truly sets the standard for keyboard enthusiasts!',
                    'image_url' => 'https://yt3.googleusercontent.com/ytc/AIdro_k_y5pZdnUqb6JRWmjPgrmf_asmnAfz7UzyZrOt6BdV9Vo=s160-c-k-c0x00ffffff-no-rj',
                    'rating' => 5,
                ],
            ];

            foreach ($reviews as $review) {
                Review::create($review);
            }
        }
    }
}

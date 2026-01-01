<?php

namespace Database\Seeders;

use App\Models\Sneaker;
use Illuminate\Database\Seeder;

class SneakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sneakers = [
            [
                'name' => 'Air Max 90',
                'brand' => 'Nike',
                'model' => 'Air Max',
                'price' => 120.00,
                'description' => 'The Nike Air Max 90 stays true to its OG running roots with the iconic Waffle sole, stitched overlays and classic TPU accents. Fresh colors give a modern look while Max Air cushioning adds comfort to your journey.',
                'image_path' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=800&fit=crop',
            ],
            [
                'name' => 'Classic Leather',
                'brand' => 'Reebok',
                'model' => 'Classic',
                'price' => 75.00,
                'description' => 'The Reebok Classic Leather sneaker features a timeless design with premium leather upper and cushioned midsole for all-day comfort. A true icon in sneaker culture.',
                'image_path' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=800&h=800&fit=crop',
            ],
            [
                'name' => 'Superstar',
                'brand' => 'Adidas',
                'model' => 'Superstar',
                'price' => 80.00,
                'description' => 'The Adidas Superstar is one of the most iconic sneakers in history. With its distinctive shell toe and serrated three stripes, it has been a street style favorite for decades.',
                'image_path' => 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=800&h=800&fit=crop',
            ],
            [
                'name' => 'Air Force 1',
                'brand' => 'Nike',
                'model' => 'Air Force',
                'price' => 90.00,
                'description' => 'The radiance lives on in the Nike Air Force 1, the basketball original that puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine.',
                'image_path' => 'https://images.unsplash.com/photo-1605348532760-6753d2c43329?w=800&h=800&fit=crop',
            ],
            [
                'name' => 'Chuck Taylor All Star',
                'brand' => 'Converse',
                'model' => 'Chuck Taylor',
                'price' => 55.00,
                'description' => 'The Converse Chuck Taylor All Star is the original basketball shoe. With its iconic design and timeless style, it has become a cultural symbol and wardrobe essential.',
                'image_path' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&h=800&fit=crop',
            ],
        ];

        foreach ($sneakers as $sneaker) {
            Sneaker::create($sneaker);
        }
    }
}

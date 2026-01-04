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
                'image_path' => 'https://asset.snipes.com/images/f_auto,q_80,d_fallback-sni.png/b_rgb:f8f8f8,c_pad,w_680,h_680/dpr_2.0/01792184_1/nike-air-max-90-schwarz-394-1',
            ],
            [
                'name' => 'Classic Nylon 1985',
                'brand' => 'Reebok',
                'model' => 'Classic',
                'price' => 75.00,
                'description' => 'The Reebok Classic Leather sneaker features a timeless design with premium leather upper and cushioned midsole for all-day comfort. A true icon in sneaker culture.',
                'image_path' => 'https://backend.thestreets.eu/media/catalog/product/cache/d184dcba75a873441633b9a309928c75/3/0/307da2827fe0123acfbf432ee41af02a0ebb7a63_sc3w70ctx0sedqsm.jpg',
            ],
            [
                'name' => 'Samba',
                'brand' => 'Adidas',
                'model' => 'Samaba Vintage',
                'price' => 80.00,
                'description' => 'The Adidas Superstar is one of the most iconic sneakers in history. With its distinctive shell toe and serrated three stripes, it has been a street style favorite for decades.',
                'image_path' => 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/b067d21288bc43ec8298a8bf01180400_9366/Samba_OG_Schuh_Weiss_B75806_04_standard.jpg',
            ],
            [
                'name' => 'Jordan Retro 1',
                'brand' => 'Jordans',
                'model' => 'Retro 1',
                'price' => 90.00,
                'description' => 'The radiance lives on in the Nike Air Force 1, the basketball original that puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine.',
                'image_path' => 'https://asset.snipes.com/images/f_auto,q_80,d_fallback-sni.png/b_rgb:f8f8f8,c_pad,w_680,h_680/dpr_1.0/02395797_1/jordan-air-jordan-1-low-schwarz-42302-1',
            ],
            [
                'name' => 'Chuck Taylor All Star',
                'brand' => 'Converse',
                'model' => 'Chuck Taylor',
                'price' => 55.00,
                'description' => 'The Converse Chuck Taylor All Star is the original basketball shoe. With its iconic design and timeless style, it has become a cultural symbol and wardrobe essential.',
                'image_path' => 'https://i.otto.de/i/otto/0ebabf6a-c883-54db-b973-248e91706249?h=1040&w=1102&sm=clamp&upscale=true&fmt=auto&qlt=40&unsharp=0,1,0.6,7',
            ],
            [
                'name' => 'Puma Suede',
                'brand' => 'Puma',
                'model' => 'Puma Suede',
                'price' => 55.00,
                'description' => 'The Puma Suede is the original basketball shoe. With its iconic design and timeless style, it has become a cultural symbol and wardrobe essential.',
                'image_path' => 'https://www.side-step.co.za/media/catalog/product/cache/ead79d362eadd98297170252f181cb50/p/m/pma4653b-puma-smash-3_0-black-white-39233601-v1_jpg.jpg',
            ],
        ];

        foreach ($sneakers as $sneaker) {
            Sneaker::create($sneaker);
        }
    }
}

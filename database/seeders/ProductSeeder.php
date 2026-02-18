<?php

// database/seeders/ProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Whole Chicken',
                'description' => 'Fresh farm-raised whole chicken.',
                'price_per_kg' => 480,
                'image' => 'https://via.placeholder.com/300x200.png?text=Whole+Chicken',
            ],
            [
                'name' => 'Chicken Thighs',
                'description' => 'Tender chicken thighs, perfect for grilling.',
                'price_per_kg' => 520,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Thighs',
            ],
            [
                'name' => 'Chicken Drumsticks',
                'description' => 'Juicy chicken drumsticks, great for frying.',
                'price_per_kg' => 500,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Drumsticks',
            ],
            [
                'name' => 'Chicken Wings',
                'description' => 'Crispy chicken wings, ideal for parties.',
                'price_per_kg' => 550,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Wings',
            ],
            [
                'name' => 'Chicken Breast Fillet',
                'description' => 'Lean and healthy chicken breast fillet.',
                'price_per_kg' => 600,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Breast',
            ],
            [
                'name' => 'Chicken Gizzards',
                'description' => 'Delicious and nutritious chicken gizzards.',
                'price_per_kg' => 350,
                'image' => 'https://via.placeholder.com/300x200.png?text=Gizzards',
            ],
            [
                'name' => 'Chicken Liver',
                'description' => 'Rich chicken liver, full of nutrients.',
                'price_per_kg' => 300,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Liver',
            ],
            [
                'name' => 'Chicken Sausages',
                'description' => 'Value-added chicken sausages, ready to cook.',
                'price_per_kg' => 650,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Sausages',
            ],
            [
                'name' => 'Chicken Mince',
                'description' => 'Ground chicken for meatballs and burgers.',
                'price_per_kg' => 580,
                'image' => 'https://via.placeholder.com/300x200.png?text=Chicken+Mince',
            ],
            [
                'name' => 'Eggs (Tray of 30)',
                'description' => 'Farm fresh eggs, tray of 30 pieces.',
                'price_per_kg' => 420, // we treat tray price as "per kg"
                'image' => 'https://via.placeholder.com/300x200.png?text=Eggs',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

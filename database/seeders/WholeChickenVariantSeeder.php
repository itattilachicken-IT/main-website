<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class WholeChickenVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch the Whole Chicken product
        $wholeChicken = Product::where('name', 'Whole Chicken')->first();

        if (!$wholeChicken) {
            $this->command->warn('⚠️ Whole Chicken not found, please run ProductSeeder first.');
            return;
        }

        // Allowed weight options
        $weights = [1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8];

        foreach ($weights as $weight) {
            $price = $wholeChicken->price_per_kg * $weight;

            ProductVariant::create([
                'product_id' => $wholeChicken->id,
                'weight'     => $weight,
                'price'      => $price,
            ]);
        }

        $this->command->info('✅ Whole Chicken variants seeded successfully.');
    }
}

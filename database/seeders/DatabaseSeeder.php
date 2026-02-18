<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call multiple seeders properly
        $this->call([
            ProductSeeder::class,
            WholeChickenVariantSeeder::class,
            AdminUserSeeder::class,
        ]);

        // Create a test user only if it doesn't exist
        User::firstOrCreate(
            ['email' => 'test@example.com'], // unique identifier
            [
                'name' => 'Test User',
                'password' => bcrypt('password123'), // change if needed
                'role' => 'customer', // default role
            ]
        );
    }
}

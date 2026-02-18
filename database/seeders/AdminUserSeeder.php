<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ecommerce.test'], // unique identifier
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // hash explicitly
                'role' => 'admin',
            ]
        );

        $this->command->info('✅ Admin user created: admin@ecommerce.test / password');
    }
}

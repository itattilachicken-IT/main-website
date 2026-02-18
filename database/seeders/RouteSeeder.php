<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        $routes = [
            ['name' => 'Ngong Road - Community to Kiserian', 'delivery_day' => 'Monday'],
            ['name' => 'Thika Road - Globe Cinema Roundabout to Kenol', 'delivery_day' => 'Tuesday'],
            ['name' => 'CBD, Upper Hill, Westlands, Kilimani, Kileleshwa, Lavington', 'delivery_day' => 'Wednesday'],
            ['name' => 'Eastern Bypass - Kamakis to Athi River', 'delivery_day' => 'Thursday'],
            ['name' => 'Northern Bypass - Ruiru town to Limuru town', 'delivery_day' => 'Friday'],
            ['name' => 'Southern Bypass - Likoni Rd to Kikuyu Town', 'delivery_day' => 'Saturday'],
        ];

        Route::insert($routes);
    }
}

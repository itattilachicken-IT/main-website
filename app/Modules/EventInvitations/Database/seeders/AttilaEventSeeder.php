<?php

namespace App\Modules\EventInvitations\Database\seeders;

use Illuminate\Database\Seeder;
use App\Modules\EventInvitations\Models\Event;
use App\Modules\EventInvitations\Models\Invitation;
use Illuminate\Support\Str;

class AttilaEventSeeder extends Seeder
{
    public function run(): void
    {
        $event = Event::create([
            'name' => 'Attila Brand Launch Event',
            'venue' => 'Thika Greens',
            'start_date' => '2025-11-28 10:00:00',
            'end_date' => '2025-11-29 18:00:00',
            'banner_url' => '/images/attila-banner.jpg',
            'description' => 'Join us for the grand launch of Attila — innovation meets excellence.'
        ]);

        // Example test invitation
        Invitation::create([
            'event_id' => $event->id,
            'guest_name' => 'John Doe',
            'guest_email' => 'john@example.com',
            'token' => (string) Str::uuid(),
        ]);
    }
}

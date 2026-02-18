<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GuestCart;
use Carbon\Carbon;

class ClearOldGuestCarts extends Command
{
    protected $signature = 'guestcarts:clear-old';
    protected $description = 'Delete guest carts older than 7 days or empty carts';

    public function handle()
    {
        $deleted = GuestCart::where('created_at', '<', Carbon::now()->subDays(7))
                    ->orWhereJsonLength('items', 0)
                    ->delete();

        $this->info("Deleted {$deleted} old or empty guest carts.");
    }
}

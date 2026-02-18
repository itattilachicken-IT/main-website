<?php

namespace App\Modules\EventInvitations;

use Illuminate\Support\ServiceProvider;

class EventInvitationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes for the module
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load views for the module
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'EventInvitations');
    }

    public function register()
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class LaunchController extends Controller
{
    // Show the launch page
    public function showLaunchPage()
    {
        return view('launch');
    }

    // Handle partnership email subscriptions
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create(['email' => $request->email]);

        return back()->with('success', 'Thank you! We will contact you with partnership info.');
    }
}

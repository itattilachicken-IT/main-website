<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function store(Request $request)
    {
        $preferences = [
            'necessary' => true,
            'analytics' => $request->boolean('analytics'),
            'marketing' => $request->boolean('marketing'),
            'preferences' => $request->boolean('preferences'),
        ];

        Cookie::queue(
            'cookie_preferences',           // Cookie name
            json_encode($preferences),      // Cookie value
            60 * 24 * 365                    // Minutes (1 year)
        );

        return response()->json([
            'message' => 'Cookie preferences saved'
        ]);
    }
}

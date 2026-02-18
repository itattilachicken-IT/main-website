<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // For now, just flash a success message
        // Later, you can store in DB or send to Mailchimp, Brevo, etc.
        return back()->with('success', '🎉 Thank you! You will be notified when our blog launches.');
    }
}

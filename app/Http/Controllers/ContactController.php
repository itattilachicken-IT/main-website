<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
    'name'    => 'required|string|max:255',
    'email'   => 'required|email',
    'phone'   => 'required|string|max:20',
    'subject' => 'required|string|in:General Inquiries,Place an Order,Investment Plans,Franchise Network',
    'message' => 'required|string',
]);


        
        Mail::raw(
            "Message from: {$request->name}\n".
            "Email: {$request->email}\n".
            "Phone: {$request->phone}\n\n".
            "{$request->message}",
            function ($mail) use ($request) {
                $mail->to('info@attilachicken.com') 
                     ->from($request->email, $request->name) 
                     ->replyTo($request->email)
                     ->subject("Contact Form: " . $request->subject);
            }
        );

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

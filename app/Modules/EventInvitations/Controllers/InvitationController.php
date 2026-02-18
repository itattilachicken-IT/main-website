<?php

namespace App\Modules\EventInvitations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EventInvitations\Models\Invitation;

class InvitationController extends Controller
{
    public function show($token)
    {
        $invite = Invitation::where('token', $token)->firstOrFail();
        $event = $invite->event;
        return view('EventInvitations::invite', compact('invite', 'event'));
    }
    
    public function uploadRsvp(Request $request)
{
    $request->validate([
        'rsvp' => 'required|file|mimes:png,jpg,jpeg|max:5120', // max 5MB
    ]);

    $file = $request->file('rsvp');
    $path = $file->store('public/rsvps');
    $url = Storage::url($path);

    return response()->json(['url' => url($url)]);
}

    
}

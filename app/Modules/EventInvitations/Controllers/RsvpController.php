<?php

namespace App\Modules\EventInvitations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EventInvitations\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RsvpController extends Controller
{
   
    public function show($token)
    {
        $invite = Invitation::where('token', $token)->firstOrFail();
        $event = $invite->event;

        
        if (in_array($invite->status, ['accepted', 'declined'])) {
            return redirect()
                ->route('rsvp.result', [$token])
                ->with('info', 'You have already responded to this invitation.');
        }

       
        if ($event->end_date < Carbon::now()) {
            return view('EventInvitations::expired', compact('event'));
        }

        
        if (is_string($event->dates)) {
            $event->dates = json_decode($event->dates, true) ?? explode(',', $event->dates);
        }

        return view('EventInvitations::rsvp', compact('invite', 'event'));
    }

   
    public function submit(Request $request, $token)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,declined',
            'event_dates' => 'nullable|array',
            'event_dates.*' => 'string',
            'attendance_type' => 'nullable|in:alone,group',
            'group_size' => 'nullable|integer|min:2|max:20',
        ]);

        $invite = Invitation::where('token', $token)->firstOrFail();

       
        $meta = [
            'event_dates' => $validated['event_dates'] ?? [],
            'attendance_type' => $validated['attendance_type'] ?? null,
            'group_size' => $validated['group_size'] ?? null,
        ];

        
        $invite->update([
            'status' => $validated['status'],
            'meta' => json_encode($meta, JSON_PRETTY_PRINT),
        ]);

        return redirect()->route('rsvp.result', [$invite->token]);
    }

   
    public function result($token)
    {
        $invite = Invitation::where('token', $token)->firstOrFail();
        $event = $invite->event;

        
        $meta = json_decode($invite->meta ?? '{}', true);
        $event_dates = $meta['event_dates'] ?? [];
        $attendance_type = $meta['attendance_type'] ?? null;
        $group_size = $meta['group_size'] ?? null;

        if ($invite->status === 'accepted') {
            return view('EventInvitations::accepted', compact(
                'invite',
                'event',
                'event_dates',
                'attendance_type',
                'group_size'
            ));
        }

        if ($invite->status === 'declined') {
            return view('EventInvitations::declined', compact('invite', 'event'));
        }

        // Default fallback (not yet responded)
        return redirect()->route('rsvp.show', [$token]);
    }
}

<?php

namespace App\Modules\EventInvitations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\EventInvitations\Models\Invitation;
use App\Modules\EventInvitations\Models\Event;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Modules\EventInvitations\Exports\InvitationsExport;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminInvitationController extends Controller
{
    
public function downloadRsvp($id)
{
    $invite = Invitation::with('event')->findOrFail($id);

    // Decode meta safely
    $meta = is_array($invite->meta) ? $invite->meta : json_decode($invite->meta, true) ?? [];

    $event_dates = $meta['event_dates'] ?? [];
    $attendanceType = $meta['attendance_type'] ?? 'alone';
    $attendanceNumber = ($attendanceType === 'group' && !empty($meta['group_size']))
        ? (int) $meta['group_size']
        : 1;

    // Pass event object in case Blade fallback is needed
    $event = $invite->event;

    // Generate PDF
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'EventInvitations::admin.invitations.pdf',
        compact('invite', 'event_dates', 'attendanceType', 'attendanceNumber', 'event')
    )->setPaper([0, 0, 600, 800]);

    $pdfDir = public_path('rsvp-pdfs');
    $imageDir = public_path('rsvp-images');

    if (!file_exists($pdfDir)) mkdir($pdfDir, 0755, true);
    if (!file_exists($imageDir)) mkdir($imageDir, 0755, true);

    $slug = \Str::slug($invite->guest_name);
    $pdfPath = $pdfDir . "/RSVP-{$slug}.pdf";
    $imagePath = $imageDir . "/RSVP-{$slug}.png";

    // Save PDF first
    $pdf->save($pdfPath);

    // Convert PDF to PNG using Imagick
    if (!extension_loaded('imagick')) {
        abort(500, 'Imagick PHP extension is not installed.');
    }

    $imagick = new \Imagick();
    
    // High-resolution PDF render
    $imagick->setResolution(300, 300);
    $imagick->readImage($pdfPath . '[0]'); // first page

    // Flatten in case PDF has transparency
    $imagick->setImageBackgroundColor('white');
    $imagick = $imagick->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);

    $imagick->setImageFormat('png');
    $imagick->trimImage(0);
    $imagick->setImagePage(0, 0, 0, 0);

    $imagick->writeImage($imagePath);
    $imagick->clear();
    $imagick->destroy();

    // Return image instead of PDF
    return response()->download($imagePath);
}


public function downloadReminderPdf($id)
{
    $invite = Invitation::with('event')->findOrFail($id);

    $invite->invite_link = route('invite.show', $invite->token);
    $invite->rsvp_result_link = route('rsvp.result', $invite->token);

    $eventDates = [];
    $eventName = '';
    if ($invite->event) {
        $eventName = $invite->event->name;
        if (!empty($invite->event->meta) && is_array($invite->event->meta)) {
            $eventDates = $invite->event->meta['event_dates'] ?? [];
        }
    }

    // Pass RSVP deadline to Blade for countdown
    $rsvpDeadline = Carbon::createFromFormat('d-m-Y', '26-11-2025');

    // Half-page dimensions
    $pdfWidth = 600;
    $pdfHeight = 400;

    $pdf = Pdf::loadView(
        'EventInvitations::admin.invitations.reminder_pdf',
        compact('invite', 'eventDates', 'eventName', 'rsvpDeadline')
    )->setPaper([0, 0, $pdfWidth, $pdfHeight]);

    $fileName = 'Reminder-' . Str::slug($invite->guest_name) . '.pdf';

    return $pdf->download($fileName);
}


    
public function index(Request $request)
{
    $eventId = $request->get('event_id');
    $status = $request->get('status');
    $search = $request->get('search');

    // All events for filter dropdown
    $events = Event::orderBy('name')->get();

    $query = Invitation::with('event')->latest();

    // Filter by event if selected
    if ($eventId) {
        $query->where('event_id', $eventId);
        $event = Event::find($eventId);
    } else {
        $event = null;
    }

    // Filter by status if selected
    if ($status) {
        $query->where('status', $status);
    }

    // Search by guest name, email, or mobile
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('guest_name', 'like', "%{$search}%")
              ->orWhere('guest_email', 'like', "%{$search}%")
              ->orWhere('guest_mobile', 'like', "%{$search}%");
        });
    }

    // Paginate filtered invitations
    $invitations = $query->paginate(20)->appends($request->query());

    // --- Summary counts (all records, not just current page) ---
    $totalAcceptedInvites = Invitation::when($eventId, fn($q) => $q->where('event_id', $eventId))
        ->where('status', 'accepted')
        ->get();

    $acceptedGuestsCount = $totalAcceptedInvites->sum(function ($invite) {
        $meta = json_decode($invite->meta, true);
        $groupSize = isset($meta['group_size']) ? (int)$meta['group_size'] : 1;
        return max($groupSize, 1);
    });

    $acceptedInvitesCount = $totalAcceptedInvites->count();
    $pendingInvitesCount = Invitation::when($eventId, fn($q) => $q->where('event_id', $eventId))
        ->where('status', 'pending')
        ->count();
    $declinedInvitesCount = Invitation::when($eventId, fn($q) => $q->where('event_id', $eventId))
        ->where('status', 'declined')
        ->count();

    $totalInvitationsCount = $acceptedInvitesCount + $pendingInvitesCount + $declinedInvitesCount;

    return view('EventInvitations::admin.index', compact(
        'invitations',
        'event',
        'events',
        'status',
        'search',
        'acceptedInvitesCount',
        'pendingInvitesCount',
        'declinedInvitesCount',
        'acceptedGuestsCount',
        'totalInvitationsCount'
    ));
}


    public function create()
    {
        $events = Event::orderBy('name')->get();
        return view('EventInvitations::admin.create', compact('events'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'guest_name' => 'required|string|max:255',
        'guest_email' => 'required|email',
        'guest_mobile' => 'nullable|string|max:20',
        'status' => 'nullable|string|max:100',
        'meta' => 'nullable|json',
    ]);

    // Check duplicate mobile number
    if (!empty($validated['guest_mobile'])) {
        $exists = Invitation::where('guest_mobile', $validated['guest_mobile'])->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'This mobile number is already registered for another guest.');
        }
    }

    $validated['token'] = Str::uuid();

    Invitation::create($validated);

    return redirect()->route('admin.invitations.index')->with('success', 'Invitation created successfully.');
}




    public function edit(Invitation $invitation)
    {
        $events = Event::orderBy('name')->get();
        return view('EventInvitations::admin.edit', compact('invitation', 'events'));
    }

    public function update(Request $request, Invitation $invitation)
{
    $validated = $request->validate([
        'event_id'     => 'required|exists:events,id',
        'guest_name'   => 'required|string|max:255',
        'guest_email'  => 'required|email',
        'guest_mobile' => [
            'nullable',
            'string',
            'max:20',
            Rule::unique('invitations', 'guest_mobile')->ignore($invitation->id),
        ],
        'status'       => 'nullable|string|max:100',
        'meta'         => 'nullable|string',
    ]);

    $validated['meta'] = $request->meta ? json_decode($request->meta, true) : null;

    $invitation->update($validated);

    return redirect()->route('admin.invitations.index')
                     ->with('success', 'Invitation updated');
}
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return redirect()->route('admin.invitations.index')->with('success', 'Invitation deleted');
    }

    /**
     * Export invitations to CSV or Excel
     */
    /**
 * Export invitations to CSV or Excel
 */
public function export(Request $request, Event $event, $format)
{
    $invitations = $event->invitations;

    // Map invitations and extract meta fields
    $exportArray = $invitations->map(function ($invite) {
        // Decode meta safely
        $meta = is_array($invite->meta) ? $invite->meta : json_decode($invite->meta, true) ?? [];

        // Extract fields from meta
        $numberOfAttendees = $meta['group_size'] ?? 1; // default to 1 if not set
        $eventDates = isset($meta['event_dates']) ? implode(', ', (array)$meta['event_dates']) : '';

        return [
            'Guest Name'          => $invite->guest_name,
            'Guest Mobile'        => $invite->guest_mobile,
            'Status'              => $invite->status,
            'Number of Attendees' => $numberOfAttendees,
            'Event Dates'         => $eventDates,
        ];
    })->toArray();

    if ($format === 'csv') {
        // Generate CSV
        $csvData = implode(',', array_keys($exportArray[0] ?? [])) . "\n"; // Header
        foreach ($exportArray as $row) {
            $csvData .= implode(',', array_map(fn($v) => "\"$v\"", $row)) . "\n";
        }

        $fileName = "invitations_event_{$event->id}.csv";

        return response($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}"
        ]);
    }

    if ($format === 'xlsx') {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Modules\EventInvitations\Exports\InvitationsExport($exportArray),
            "invitations_event_{$event->id}.xlsx"
        );
    }

    abort(404);
}


/**
 * Export invitations for the single event (shortcut for admins)
 */

     //use App\Modules\EventInvitations\Models\Event;

public function exportSingle(Request $request, $format)
{
    $status = $request->query('status', 'all');

    // Load the event with invitations filtered by status
    $event = Event::with(['invitations' => function ($q) use ($status) {
        if ($status !== 'all') {
            $q->where('status', ucfirst($status));
        }
    }])->findOrFail(1);

    // Ensure Excel-safe mobile numbers (preserves leading zeros)
    foreach ($event->invitations as $invitation) {
        $invitation->guest_mobile = "'".$invitation->guest_mobile;
    }

    // Export using the cleaned-up export method
    return $this->export($request, $event, $format);
}



}

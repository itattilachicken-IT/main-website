@extends('layouts.app')

@section('content')
<div class="container my-2">
    <h2>
        Invitations for {{ isset($event) ? $event->name : 'All Events' }}
    </h2>
    
    <div class="mb-4 d-flex gap-2">

    @php
        $statuses = [
            'all' => 'All',
            'accepted' => 'Accepted',
            'pending' => 'Pending',
            'declined' => 'Declined',
            'attended' => 'Attebded',
        ];
    @endphp

    @foreach ($statuses as $key => $label)
        <a href="{{ route('admin.invitations.exportSingle', 'xlsx') }}{{ $key !== 'all' ? '?status='.$key : '' }}"
           class="btn 
                  @if($key === 'all') btn-secondary 
                  @elseif($key === 'accepted') btn-success
                  @elseif($key === 'pending') btn-warning
                  @elseif($key === 'declined') btn-danger 
                  @elseif($key === 'attended') btn-info 
                  @endif"
           target="_blank">
            Download {{ $label }}
        </a>
    @endforeach

</div>


    <div class="mb-3 d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Left: Action Buttons -->
        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('admin.invitations.create') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Add New Invitation
            </a>

            @php
                $eventParam = request('event_id') ?: 'all';
                $filters = request()->only(['status', 'search']);
            @endphp

            <a href="{{ route('admin.invitations.export', array_merge(['event' => $eventParam, 'format' => 'csv'], $filters)) }}" class="btn btn-success">
                <i class="fa fa-file-csv"></i> Export CSV
            </a>

            <a href="{{ route('admin.invitations.export', array_merge(['event' => $eventParam, 'format' => 'xlsx'], $filters)) }}" class="btn btn-success">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
        </div>

        <!-- Center: Filters -->
        <form method="GET" action="{{ route('admin.invitations.index') }}" class="d-flex flex-wrap align-items-center gap-2">
            <select name="event_id" class="form-select" style="max-width: 200px;">
                <option value="">All Events</option>
                @foreach($events as $ev)
                    <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                        {{ $ev->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="form-select" style="max-width: 180px;">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="declined" {{ request('status') == 'declined' ? 'selected' : '' }}>Declined</option>
                 <option value="attended" {{ request('status') == 'attended' ? 'selected' : '' }}>Attended</option>
            </select>

            <input type="text" name="search" class="form-control"
                   placeholder="Search name, email, or mobile"
                   value="{{ request('search') }}" style="max-width: 200px;">

            <button class="btn btn-secondary">Filter</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Stats -->
    <div class="d-flex justify-content-start gap-4 mb-4 p-3 bg-light rounded">
        <div class="text-center px-3 py-2 bg-white rounded shadow-sm">
            <div class="text-muted small">Total Invitations</div>
            <div class="fw-bold">{{ $totalInvitationsCount }}</div>
        </div>
        <div class="text-center px-3 py-2 bg-white rounded shadow-sm">
            <div class="text-muted small">Accepted Invitations</div>
            <div class="fw-bold">{{ $acceptedInvitesCount }}</div>
        </div>
        <div class="text-center px-3 py-2 bg-white rounded shadow-sm">
            <div class="text-muted small">Total Guests Attending</div>
            <div class="fw-bold">{{ $acceptedGuestsCount }}</div>
        </div>
        <div class="text-center px-3 py-2 bg-white rounded shadow-sm">
            <div class="text-muted small">Pending Invitations</div>
            <div class="fw-bold">{{ $pendingInvitesCount }}</div>
        </div>
        <div class="text-center px-3 py-2 bg-white rounded shadow-sm">
            <div class="text-muted small">Declined Invitations</div>
            <div class="fw-bold">{{ $declinedInvitesCount }}</div>
        </div>
    </div>

    <!-- Invitations Table -->
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Guest Name</th>
                <th>Guest Email</th>
                <th>Guest Mobile</th>
                <th>Status</th>
                <th>RSVP Details</th>
                <th style="width: 400px;">Actions</th>
            </tr>
        </thead>

        <tbody>
        @forelse($invitations as $invite)

            @php
                $inviteUrl = route('invite.show', $invite->token);
                $whatsappNumber = preg_replace('/[^0-9]/', '', $invite->guest_mobile);
                $eventName = $invite->event->name ?? 'Event';

                // Standard WhatsApp RSVP
                $whatsappText = "Hello {$invite->guest_name}!\n\nYou're invited to the *{$eventName}*\n\nRSVP here: {$inviteUrl}";
                $whatsappLink = "https://wa.me/{$whatsappNumber}?text=" . rawurlencode($whatsappText);

                $emailSubject = urlencode("RSVP for {$eventName}");
                $emailBody = urlencode("Hello {$invite->guest_name},\n\nYou're invited to *{$eventName}*\n\nRSVP here: {$inviteUrl}");
            @endphp

            <tr>
                <td>{{ $invite->guest_name }}</td>
                <td>{{ $invite->guest_email }}</td>
                <td>{{ $invite->guest_mobile }}</td>

                <td>
                    <span class="badge
                        @if($invite->status === 'accepted') bg-success
                        @elseif($invite->status === 'declined') bg-danger
                        @else bg-secondary
                        @endif">
                        {{ ucfirst($invite->status) }}
                    </span>
                </td>

                <td>
                    @php $meta = json_decode($invite->meta, true); @endphp
                    @if(is_array($meta) && !empty($meta))
                        <ul class="list-unstyled mb-0">
                            @foreach($meta as $key => $value)
                                <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong>
                                    {{ is_array($value) ? implode(', ', $value) : $value }}</li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">–</span>
                    @endif
                </td>

                <td style="vertical-align: middle;">

                    <!-- Edit -->
                    <a href="{{ route('admin.invitations.edit', $invite->id) }}" class="btn btn-sm btn-warning me-1">
                        <i class="fa fa-edit"></i> Edit
                    </a>

                    <!-- View Invitation -->
                    <a href="{{ $inviteUrl }}" target="_blank" class="invite-link-preview btn btn-sm btn-primary me-1">
                        <i class="fa fa-eye"></i> View Invitation
                    </a>

                    <!-- WhatsApp RSVP -->
                    @if($whatsappNumber)
                        <a href="{{ $whatsappLink }}" target="_blank" class="btn btn-sm btn-success me-1">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp RSVP
                        </a>
                    @endif

                    <!-- Email RSVP -->
                    <a href="mailto:{{ $invite->guest_email }}?subject={{ $emailSubject }}&body={{ $emailBody }}" class="btn btn-sm btn-info me-1 text-white">
                        <i class="fa fa-envelope"></i> Email RSVP
                    </a>

                    <!-- If accepted: download + share RSVP -->
                    @if($invite->status === 'accepted')
                        <a href="{{ route('admin.invitations.downloadRsvp', $invite->id) }}" target="_blank" class="btn btn-sm btn-secondary me-1">
                            <i class="fa fa-download"></i> Download RSVP
                        </a>

                        <button class="btn btn-sm btn-success me-1 generate-share-rsvp"
                                data-invite-url="{{ $inviteUrl }}"
                                data-guest-name="{{ $invite->guest_name }}"
                                data-event-name="{{ $eventName }}">
                            <i class="fa fa-paper-plane"></i> Share RSVP
                        </button>
                    @endif

                    <!-- Pending: WhatsApp Reminder -->
                    @if($invite->status === 'pending')
                        @if($whatsappNumber)
                            @php
                                // Reminder uses fixed deadline
                                $deadlineFormatted = '26th Nov 2025';

                                $rsvpLink = $invite->rsvp_result_link;

                                $reminderText =
                                    "Hello {$invite->guest_name},\n\n".
                                    "This is a reminder to RSVP for the *{$eventName}* by {$deadlineFormatted}.\n".
                                    "Reserve your spot here: {$rsvpLink}";

                                $reminderLink = "https://wa.me/{$whatsappNumber}?text=" . rawurlencode($reminderText);
                            @endphp

                            <a href="{{ $reminderLink }}" target="_blank" class="btn btn-sm btn-warning me-1">
                                <i class="fa-brands fa-whatsapp"></i> Send Reminder
                            </a>
                        @endif
                    @endif

                    <!-- Download Reminder PDF -->
                    <a href="{{ route('admin.invitations.downloadReminderPdf', $invite->id) }}" target="_blank" class="btn btn-sm btn-secondary me-1">
                        <i class="fa fa-download"></i> Download Reminder PDF
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.invitations.destroy', $invite->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this invitation?')">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">No invitations found.</td>
            </tr>
        @endforelse
        </tbody>

    </table>

    {{ $invitations->links() }}
</div>

<!-- Hidden RSVP Template -->
<div id="rsvp-template" style="display:none; width:600px; max-width:90vw; padding:20px; background:#fff; color:#000; font-family:Poppins, sans-serif; text-align:center; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.2);">
    <img id="rsvpBanner" src="{{ asset('images/rsvp-banner.jpg') }}" alt="RSVP Banner" style="width:100%; height:auto; border-radius:10px; margin-bottom:15px;">
    <h2 id="rsvpGuestName" style="font-size:1.5rem; margin-bottom:10px;">Guest Name</h2>
    <p id="rsvpEventName" style="font-size:1.1rem; margin-bottom:10px;">Event Name</p>
    <p id="rsvpLink" style="font-size:0.9rem; color:#555; margin-bottom:10px;">Invite Link</p>
    <p id="rsvpSpots" style="font-size:1.1rem; margin-bottom:15px;">Number of Spots: 1</p>
    <p style="margin-top:20px; font-size:0.95rem; color:#555;">We look forward to seeing you!</p>
</div>

@push('styles')
<style>
h2 { font-family: 'Poppins', sans-serif; font-weight: 600; margin-bottom: 1.5rem; color: #C21807; }
.invite-link-preview {
    position: relative; background: linear-gradient(90deg, #FFD84C, #FFC107);
    border: none; color: #222; font-weight: 600;
    overflow: hidden; transition: all 0.3s ease-in-out;
}
.invite-link-preview:hover {
    background: linear-gradient(90deg, #C21807, #FF5252);
    color: #fff; transform: scale(1.05);
    box-shadow: 0 0 12px rgba(255, 216, 76, 0.6);
}
.btn-success {
    background: linear-gradient(90deg, #25D366, #128C7E);
    border: none; color: #fff; font-weight: 600;
    transition: all 0.3s ease-in-out;
}
.btn-success:hover {
    background: linear-gradient(90deg, #128C7E, #25D366);
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(37,211,102,0.4);
}
.btn-secondary {
    background: linear-gradient(90deg, #FFA000, #FFB74D);
    border: none; color: #fff; font-weight: 600;
}
.btn-secondary:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(255,167,0,0.4);
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const rsvpTemplate = document.getElementById('rsvp-template');

    // Download RSVP PDF
    document.querySelectorAll('.download-rsvp').forEach(btn => {
        btn.addEventListener('click', async () => {
            const inviteUrl = btn.dataset.inviteUrl;
            const guestName = btn.dataset.guestName;
            const eventName = btn.dataset.eventName;

            rsvpTemplate.querySelector('#rsvpGuestName').textContent = guestName;
            rsvpTemplate.querySelector('#rsvpEventName').textContent = eventName;
            rsvpTemplate.querySelector('#rsvpLink').textContent = inviteUrl;
            rsvpTemplate.style.display = 'block';

            const canvas = await html2canvas(rsvpTemplate, { scale: 2 });
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'px',
                format: [canvas.width, canvas.height]
            });
            pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
            pdf.save(`RSVP-${guestName}.pdf`);

            rsvpTemplate.style.display = 'none';
        });
    });

    // Generate & Share via WhatsApp
    document.querySelectorAll('.generate-share-rsvp').forEach(btn => {
        btn.addEventListener('click', async () => {
            const inviteUrl = btn.dataset.inviteUrl;
            const guestName = btn.dataset.guestName;
            const eventName = btn.dataset.eventName;

            rsvpTemplate.querySelector('#rsvpGuestName').textContent = guestName;
            rsvpTemplate.querySelector('#rsvpEventName').textContent = eventName;
            rsvpTemplate.querySelector('#rsvpLink').textContent = inviteUrl;
            rsvpTemplate.style.display = 'block';

            const canvas = await html2canvas(rsvpTemplate, { scale: 2 });
            const imgData = canvas.toDataURL('image/png');
            const blob = await (await fetch(imgData)).blob();
            const formData = new FormData();
            formData.append('rsvp', blob, `RSVP-${guestName}.png`);

            try {
                const response = await fetch("{{ route('admin.invitations.uploadRsvp') }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                });

                const data = await response.json();

                if (data.url) {
                    const text = encodeURIComponent(`Hello ${guestName}! Your RSVP for ${eventName} is ready: ${data.url}`);
                    window.open(`https://wa.me/?text=${text}`, '_blank');
                } else {
                    alert('Failed to upload RSVP. Please try again.');
                }

            } catch (err) {
                console.error(err);
                alert('Error uploading RSVP.');
            }

            rsvpTemplate.style.display = 'none';
        });
    });
});
</script>
@endpush
@endsection

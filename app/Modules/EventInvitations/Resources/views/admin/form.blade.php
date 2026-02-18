<div class="mb-3">
    <label>Event</label>
    <select name="event_id" class="form-control" required>
        <option value="">Select Event</option>
        @foreach($events as $event)
            <option value="{{ $event->id }}" 
                {{ (isset($invitation) && $invitation->event_id == $event->id) ? 'selected' : '' }}>
                {{ $event->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Guest Name</label>
    <input type="text" name="guest_name" class="form-control" 
           value="{{ $invitation->guest_name ?? old('guest_name') }}" required>
</div>

<div class="mb-3">
    <label>Guest Email</label>
    <input type="email" name="guest_email" class="form-control" 
           value="{{ $invitation->guest_email ?? old('guest_email') }}" required>
</div>

<!-- New Guest Mobile field -->
<div class="mb-3">
    <label>Guest Mobile</label>
    <input type="text" name="guest_mobile" class="form-control" 
           value="{{ $invitation->guest_mobile ?? old('guest_mobile') }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <input type="text" name="status" class="form-control" 
           value="{{ $invitation->status ?? old('status') }}">
</div>

<div class="mb-3">
    <label>Meta (JSON)</label>
    <textarea name="meta" class="form-control">
    {{ $invitation->meta ? json_encode($invitation->meta, JSON_PRETTY_PRINT) : old('meta') }}
</textarea>

</div>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Invitation</h2>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <form action="{{ route('admin.invitations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-control" required>
                <option value="">Select Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Guest Name</label>
            <input type="text" name="guest_name" class="form-control" 
                   value="{{ old('guest_name') }}" required>
        </div>

        <div class="mb-3">
            <label>Guest Email</label>
            <input type="email" name="guest_email" class="form-control" 
                   value="{{ old('guest_email') }}" required>
        </div>

        <div class="mb-3">
            <label>Guest Mobile</label>
            <input type="text" name="guest_mobile" class="form-control" 
                   value="{{ old('guest_mobile') }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" 
                   value="{{ old('status', 'Pending') }}">
        </div>

        <div class="mb-3">
            <label>Token</label>
            <input type="text" name="token" class="form-control" 
                   value="{{ Str::uuid() }}" readonly>
        </div>

        <div class="mb-3">
            <label>Meta (JSON)</label>
            <textarea name="meta" class="form-control">{{ old('meta') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Invitation</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('error'))
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-bg-danger border-0 show position-fixed bottom-0 end-0 m-3';
        toast.role = 'alert';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>`;
        document.body.appendChild(toast);
        new bootstrap.Toast(toast).show();
    @elseif(session('success'))
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-bg-success border-0 show position-fixed bottom-0 end-0 m-3';
        toast.role = 'alert';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>`;
        document.body.appendChild(toast);
        new bootstrap.Toast(toast).show();
    @endif
});
</script>
@endpush


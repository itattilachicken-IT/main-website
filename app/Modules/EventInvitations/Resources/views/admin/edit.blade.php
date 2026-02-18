@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>Edit Invitation</h2>

    <form action="{{ route('admin.invitations.update', $invitation->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('EventInvitations::admin.form')
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

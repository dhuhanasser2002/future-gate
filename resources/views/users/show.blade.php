@extends('layouts.app')

@section('title', $user->username)

@section('content')
<div class="profile-container mx-auto mt-5" style="max-width: 600px;">
    <div class="card">
        <div class="card-body text-center">
            @if ($user->image)
                <img src="{{ asset('images/' . $user->image) }}" alt="{{ $user->username }}'s Profile Image" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px;">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Image" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px;">
            @endif

            <h2 class="card-title mb-2">{{ $user->username }}</h2>
            <p class="text-muted">{{ $user->email }}</p>
            
            <div class="mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.profile-container {
    max-width: 600px;
    margin: 0 auto;
}

.card-body {
    padding: 30px;
}

.card-title {
    font-size: 1.5rem;
    font-weight: bold;
}

img.rounded-circle {
    border-radius: 50%;
    object-fit: cover;
}

.text-muted {
    color: #6c757d;
    font-size: 1rem;
}
</style>
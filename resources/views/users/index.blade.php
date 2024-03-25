@extends('layouts.app')

@section('title', '‘Users')

@section('content')
<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-5">Create User</a>
<a href="{{route('users.trash')}}" class="btn btn-warning btn-sm mb-5">Blocked User</a>
    <div class="container">
        <h1 class="my-4">Users</h1>
        <div class="row">
            @forelse ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Post Image" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <div class="mt-2">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to block this user?')">Block</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>no users</h2>
            @endforelse
        </div>
    </div>
@endsection
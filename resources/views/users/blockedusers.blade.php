@extends('layouts.app')

@section('title', 'Blocked Users')

@section('content')
<a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mb-5">Users</a>
    <div class="container">
        <h1 class="my-4">Users</h1>
        <div class="row">
<<<<<<< HEAD
            @forelse ($users as $user)
=======
            @forelse ($trashedUsers  as $user)
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Post Image" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <div class="mt-2">
<<<<<<< HEAD
                                form action="{{ route('users.restore', $user->id) }}" method="POST"
=======
                                <form action="{{ route('users.restore', $user->id) }}" method="POST"
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
                                style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary btn-sm">Unblock</button>
                            </form>
                              <form action="{{ route('users.forceDelete', $user->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>no Blocked users</h2>
            @endforelse
        </div>
    </div>
@endsection
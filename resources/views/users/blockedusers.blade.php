@extends('layouts.app')

@section('title', 'Blocked Users')

@section('content')
<a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mb-5">Users</a>
<div class="container">
    <h1 class="my-4">Blocked Users</h1>
    <div class="row">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trashedUsers as $user)
                <tr>
                    <td>
                        @if ($user->image)
                        <img src="{{ asset('images/' . $user->image) }}" alt="User Image" width="50px">
                        @endif
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td>
                        <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary btn-sm">Unblock</button>
                        </form>
                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center"><h2>No blocked users found</h2></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection